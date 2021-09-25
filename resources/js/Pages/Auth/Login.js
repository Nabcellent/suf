import React, {useEffect} from 'react';
import Button from '@/Components/Button';
import Checkbox from '@/Components/Checkbox';
import Guest from '@/Layouts/Guest';
import Input from '@/Components/Input';
import Label from '@/Components/Label';
import ValidationErrors from '@/Components/ValidationErrors';
import {Head, Link, useForm} from '@inertiajs/inertia-react';

export default function Login({status, canResetPassword}) {
    const {data, setData, post, processing, errors, reset} = useForm({
        email: '',
        password: '',
        remember: '',
    });

    useEffect(() => {
        return () => {
            reset('password');
        };
    }, []);

    const onHandleChange = (event) => {
        setData(event.target.name, event.target.type === 'checkbox' ? event.target.checked : event.target.value);
    };

    const submit = (e) => {
        e.preventDefault();

        post(route('login'));
    };

    return (
        <Guest status={status}>
            <div className="login">
                <Head><title>Sign In</title></Head>

                <div id="content">
                    <div className="container registration_page_container">

                        {status && <div className="mb-4 font-medium text-sm text-green-600">{status}</div>}

                        <div className="row">
                            <div className="col-md-12">
                                <nav aria-label="breadcrumb">
                                    <ul className="breadcrumb">
                                        <li className="breadcrumb-item"><a href="/">Su-F</a></li>
                                        <li className="breadcrumb-item active" aria-current="page">Login</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <div className="row justify-content-center align-items-center" style={{height:'70vh', marginBottom:'10rem'}}>
                            <div className="col-md-11 col-sm-12">
                                <div className="card shadow mx-auto mt-md-5" style={{maxWidth:'30rem'}}>

                                    <div className="card-header">
                                        <h4>Sign In</h4>
                                        <ValidationErrors errors={errors}/>
                                        <hr className="bg-info m-0"/>
                                    </div>

                                    <div className="card-body pb-0 anime_card">
                                        <form onSubmit={submit} id="login_form" className="anime_form">
                                            <div className="form-group">
                                                <Label forInput="email" value="Email"/>
                                                <Input type="text" name="email" value={data.email} className="mt-1 block w-full"
                                                       autoComplete="username"
                                                       isFocused={true}
                                                       handleChange={onHandleChange} placeholder={'Email address *'} required/>
                                            </div>

                                            <div className="form-group">
                                                <Label forInput="password" value="Password"/>
                                                <Input type="password" name="password" value={data.password} className="mt-1 block w-full"
                                                       autoComplete="current-password"
                                                       handleChange={onHandleChange} required placeholder={'Password *'}/>
                                            </div>

                                            <div className="block mt-4">
                                                <label className="flex items-center">
                                                    <Checkbox name="remember" value={data.remember} handleChange={onHandleChange}/>
                                                    <span className="ml-2 text-sm text-gray-600">Remember me</span>
                                                </label>
                                            </div>

                                            <div className="flex items-center justify-end mt-4">
                                                {canResetPassword && (
                                                    <Link href={route('password.request')}
                                                          className="underline text-sm text-gray-600 hover:text-gray-900">
                                                        Forgot your password?
                                                    </Link>
                                                )}

                                                <Button className="ml-4" processing={processing}>Log in</Button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Guest>
    );
}
