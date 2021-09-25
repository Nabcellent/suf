import {ErrorBoundary} from "@/Helpers/ErrorBoundary";

require('./bootstrap');

import React from 'react';
import {render} from 'react-dom';
import {createInertiaApp} from '@inertiajs/inertia-react';
import {InertiaProgress} from '@inertiajs/progress';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}`),
    setup({el, App, props}) {
        return render((
            <ErrorBoundary>
                <App {...props} />
            </ErrorBoundary>
        ), el);
    },
});

InertiaProgress.init({color: '#4B5563'});
