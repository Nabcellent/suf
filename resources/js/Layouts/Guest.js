import React from 'react';

export default function Guest({ children }) {
    return (
        <div>
            <header id="top_header" className="navigation-sticky">
                <nav className="navbar navbar-expand-lg sticky-top navbar-dark bg-dark top_header">
                    <div className="container">
                        <a className="navbar-brand" href="/">
                            <img src={'/images/general/store_logo.jpg'} alt="SU-F logo" className="img-fluid main_logo"/>
                        </a>

                        <div id="navbarSupportedContent">
                            <ul className="navbar-nav ml-auto">

                                <li className="nav-item d-none d-md-block">
                                    <a className="nav-link" style={{transform: 'scale(1)'}}>Hey There!👋 You might wanna</a>
                                </li>
                                <li className="nav-item d-none d-md-block" style={{textDecoration: 'underline'}}>
                                    <a className="nav-link" href={route('register')}>Register</a>
                                </li>
                                <li className="nav-item d-none d-md-block"><a className="nav-link">or</a></li>
                                <li className="nav-item d-none d-md-block" style={{textDecoration: 'underline'}}>
                                    <a className="nav-link" href={route('login')}>Sign In</a>
                                </li>
                                <div className="d-flex align-items-center d-md-none text-light">
                                    <a className="nav-link" href={route('register')}>Register</a> <span className="px-1">/</span> <a
                                    className="nav-link" href={route('login')}>Sign In</a>
                                </div>

                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

            {children}
        </div>
    );
}
