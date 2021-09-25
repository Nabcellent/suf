import React from 'react';

export default function TopHeader({auth}) {
    return (
        <header id="top_header" className="navigation-sticky">
            <nav className="navbar navbar-expand-lg sticky-top navbar-dark bg-dark top_header">
                <div className="container">
                    <a className="navbar-brand" href="/">
                        <img src={'/images/general/store_logo.jpg'} alt="SU-F logo" className="img-fluid main_logo"/>
                    </a>

                    <div id="navbarSupportedContent">
                        <ul className="navbar-nav ml-auto">

                            {auth.user ? (
                                auth.user.email_verified_at ? (
                                    <li className="nav-item dropdown">
                                        <a className="nav-link" href="#" data-toggle="dropdown">
                                            {`${auth.user.first_name} ${auth.user.last_name}`}

                                            {auth.user.image ? (
                                                    <img src={`/images/users/profile/${auth.user.image}`} className="img-fluid" alt=""
                                                         data-toggle="dropdown"
                                                         style={{width: '1.7rem', height: '1.7rem', borderRadius: '50%', objectFit: 'cover'}}/>)
                                                : (<i className="fas fa-user-circle"/>)
                                            }
                                        </a>
                                        <div className="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a className="dropdown-item" href={route('checkout')}>Checkout</a>
                                            <a className="dropdown-item" href={route('orders')}>My Orders</a>
                                            <a className="dropdown-item" href={route('profile')}>My Account</a>
                                            <div className="dropdown-divider"/>
                                            <a className="dropdown-item" href={route('logout')}>Sign Out</a>
                                        </div>
                                    </li>
                                ) : (
                                    <>
                                        <li className="nav-item">
                                            <a className="nav-link" style="transform: scale(1);">Almost There😁</a>
                                        </li>
                                        <li className="nav-item" style="text-decoration: underline;">
                                            <a className="nav-link" style="text-decoration: underline;" href={route('logout')}
                                               onClick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                                        </li>
                                        <form id="logout-form" action={route('logout')} method="POST" style="display: none;">
                                        </form>
                                    </>
                                )) : (
                                <>
                                    <li className="nav-item d-none d-md-block">
                                        <a className="nav-link" style="transform: scale(1);">Hey There!👋 You might wanna</a>
                                    </li>
                                    <li className="nav-item d-none d-md-block" style="text-decoration: underline;">
                                        <a className="nav-link" href={route('register')}>Register</a>
                                    </li>
                                    <li className="nav-item d-none d-md-block"><a className="nav-link">or</a></li>
                                    <li className="nav-item d-none d-md-block" style="text-decoration: underline;">
                                        <a className="nav-link" href={route('login')}>Sign In</a>
                                    </li>
                                    <div className="d-flex align-items-center d-md-none text-light">
                                        <a className="nav-link" href={route('register')}>Register</a> <span className="px-1">/</span> <a
                                        className="nav-link" href={route('login')}>Sign In</a>
                                    </div>
                                </>
                            )}

                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    );
}
