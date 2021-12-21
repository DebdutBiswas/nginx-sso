function redirectHttpToHttps()
{
    var httpURL= window.location.hostname + window.location.pathname + window.location.search;
    var httpsURL= "https://" + httpURL;
    window.location = httpsURL;
}
redirectHttpToHttps();