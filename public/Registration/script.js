window.addEventListener('load', function() {
    const url = new URL(window.location);
    if (url.searchParams.has('login_error')) {
        url.searchParams.delete('login_error');
        window.history.replaceState(null, null, url);
    }
    if (url.searchParams.has('signup_error')) {
        url.searchParams.delete('signup_error');
        window.history.replaceState(null, null, url);
    }
});