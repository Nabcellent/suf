@extends('/layouts.master')
@section('title', 'Policies')
@section('content')
    @include('/partials/top_nav')

<?php
$tabMenu = '';
$tabContent = '';

$i = 0;
foreach($policies as $item) {
    if($i === 0) {
        $tabMenu .= '
        <li class="nav-item">
            <a href="#' . $item["pol_link"] . '" class="nav-link active" data-toggle="tab">' . $item["pol_title"] . '</a>
        </li>
        ';

        $tabContent .= '<div class="tab-pane fade show active" id="' . $item["pol_link"] . '">' . $item["pol_description"] . '</div>';
    } else {
        $tabMenu .= '
        <li class="nav-item">
            <a href="#' . $item["pol_link"] . '" class="nav-link" data-toggle="tab">' . $item["pol_title"] . '</a>
        </li>
        ';

        $tabContent .= '<div class="tab-pane fade" id="' . $item["pol_link"] . '">' . $item["pol_description"] . '</div>';
    }

    $i++;
}

?>

<!--    End Sticky Header    -->

<!--    Start Sticky Header Jumbotron    -->
<div id="back_to_top"></div>

<div class="header-jumbotron">

<!--    Start Content Area    -->

    <div id="content">
        <div class="container shop_page_container">

            <!--    Start Breadcrumb    -->

            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Our Terms & Conditions | Refund</li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--    End Breadcrumb    -->

            <div class="row pb-3">

                <!--    Start Tab Content    -->

                <div class="col">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <?= $tabMenu ?>

                    </ul>
                    <div class="tab-content" id="myTabContent">

                        <?= $tabContent ?>

                        <a href="#back_to_top" class="btn btn-outline-light float-right rounded-circle">
                            <h4><i class="fas fa-arrow-alt-circle-up"></i></h4>
                        </a>
                    </div>
                </div>
                <!--    End Tab Content    -->
            </div>
        </div>
    </div>
    <!--    End Content Area    -->

</div>
<!--    End Sticky Header Jumbotron    -->

@endsection
