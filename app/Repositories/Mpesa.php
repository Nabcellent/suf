<?php


namespace App\Repositories;


use App\Events\StkPushFailed;
use App\Events\StkPushSuccess;
use App\Models\StkCallback;
use App\Models\StkRequest;
use Exception;
use Gahlawat\Slack\Facade\Slack;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use function config;

class Mpesa
{
    /**
     * @param string $json
     * @return $this|array|Model
     */
    public function processStkPushCallback($json): Model|array|static {
        $data = json_decode($json)->stkCallback;

        $real_data = [
            'merchant_request_id' => $data->MerchantRequestID,
            'checkout_request_id' => $data->CheckoutRequestID,
            'result_code' => $data->ResultCode,
            'result_desc' => $data->ResultDesc,
        ];

        if ($data->ResultCode == 0) {
            $_payload = $data->CallbackMetadata->Item;
            foreach ($_payload as $callback) {
                $real_data[Str::snake($callback->Name)] = @$callback->Value;
            }
        }

        Log::debug(json_encode($real_data));

        $callback = StkCallback::create($real_data);
        $this->fireStkEvent($callback, get_object_vars($data));

        return $callback;
    }

    /**
     * @param $title
     * @param bool $important
     */
    public function notification($title, bool $important = false): void
    {
        $slack = config('mpesa.notifications.slack_web_hook');

        if (!$important && empty($slack) && config('mpesa.notifications.only_important')) {
            return;
        }

        config([
            'slack.incoming-webhook' => config('mpesa.notifications.slack_web_hook'),
            'slack.default_username' => 'MPESA',
            'slack.default_emoji' => ':mailbox_with_mail:',
        ]);

        Slack::send($title);
        Slack::send('```' . json_encode(request()->all(), JSON_PRETTY_PRINT) . '```');
    }

    /**
     * @return array
     */
    public function queryStkStatus(): array
    {
        /** @var StkRequest[] $stk */
        $stk = StkRequest::whereDoesntHave('response')->get();
        $success = $errors = [];

        foreach ($stk as $item) {
            try {
                $status = mpesaStkStatus($item->id);

                if (isset($status->errorMessage)) {
                    $errors[$item->checkout_request_id] = $status->errorMessage;
                    continue;
                }
                $attributes = [
                    'merchant_request_id' => $status->MerchantRequestID,
                    'checkout_request_id' => $status->CheckoutRequestID,
                    'result_code' => $status->ResultCode,
                    'ResultDesc' => $status->ResultDesc,
                    'amount' => $item->amount,
                ];

                $errors[$item->checkout_request_id] = $status->ResultDesc;
                $callback = StkCallback::create($attributes);
                $this->fireStkEvent($callback, get_object_vars($status));
            } catch (Exception $e) {
                $errors[$item->checkout_request_id] = $e->getMessage();
            }
        }

        return ['successful' => $success, 'errors' => $errors];
    }

    /**
     * @param StkCallback $stkCallback
     * @param array       $response
     * @return StkCallback
     */
    private function fireStkEvent(StkCallback $stkCallback, array $response): StkCallback
    {
        if ($stkCallback->result_code === 0) {
            StkPushSuccess::dispatch($stkCallback, $response);
        } else {
            StkPushFailed::dispatch($stkCallback, $response);
        }

        return $stkCallback;
    }
}
