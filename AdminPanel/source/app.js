const express = require('express');
app = express();
const bodyParser = require('body-parser');
const favicon = require('serve-favicon');
const createError = require('http-errors');
const methodOverride = require('method-override');
const fileUpload = require('express-fileupload');
const cors = require('cors');
const path = require('path');
const expressLayout = require('express-ejs-layouts');
require('dotenv').config();


app.use(cors());
app.use(express.urlencoded({extended: false})); //==    Parse URL-encoded bodies (as sent by HTML forms)
app.use(express.json());    //==    Parse JSON bodies (as sent by API clients)
app.use(bodyParser.json());
app.use(methodOverride('_method'));
app.use(fileUpload(undefined));


//==    Static Files
const publicDir = path.join(__dirname, '../public');
const LaravelPublicDir = path.join(__dirname, '../../public');
app.use(express.static(publicDir));
app.use(express.static(LaravelPublicDir));
app.use(favicon(path.join(__dirname, '../public', 'favicon.ico')));


//==    Set Templating Engine
app.use(expressLayout);
app.set('layout', './layouts/navless');
app.set('views', './views');
app.set('view engine', 'ejs');


//==    Setting Session
const session = require('express-session');
const flash = require('connect-flash');
app.use(session({
    secret: process.env.SESSION_SECRET,
    resave: false,
    saveUninitialized: false
}));

app.use(flash());

//==    Flash Messages
app.use((req, res, next) => {
    res.locals.message = req.session.message
    delete req.session.message
    next()
})


//==    Configure passport middleware
const passport = require('passport');
app.use(passport.initialize());
app.use(passport.session());


//==    Defining Routes
const apiRoutes = require('./Api/Routes');
app.use(apiRoutes);


//  Error Handling
app.use(async (req, res, next) => {
    next(createError(404, 'This route does not exist.'));
});

app.use((err, req, res, next) => {
    res.status = err.status || 500;

    res.render('error', {
        Title: 'Error',
        error: {
            status: err.status || 500,
            message: err.message
        }
    })
});



const PORT = process.env.PORT || 3000;
app.listen(PORT, () => console.log(`Server Running on Port: ${PORT}`))
