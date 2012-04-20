/* 
 * @author 490501
 * @date 18.04.2012
 * @version 1.0.0
 */
function check() { //sjekker om brukernavn eller email eksisterer i database og sjekker om passord er lik i begge to feltene og at passord er godt nok dvs minst 6 tegn
    //henter variabler fra form
    var name = document.getElementById('txtUserId').value;
    var email = document.getElementById('txtEmail').value;
    var output = ajaxCheck(name,email);
    if( output == "User exists" || output == "Email exists"){
        document.getElementById("errorMessage").innerHTML=output; 
        return false;
    }
    else {
        var pass1 = document.getElementById("txtPassword").value;
        var pass2 = document.getElementById("txtPassword2").value;
        if(pass1 === pass2) {
            if(pass1.length < 6) {
                document.getElementById("errorMessage").innerHTML="min length is 6 signs";
                return false;                
            }
            else {
                //kan sjekke epost format også
                //from http://www.regular-expressions.info/email.html
                var regex = "[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?";
                if(email.match(regex) != null) {
                    return true;
                }
                else {
                document.getElementById("errorMessage").innerHTML="dummy email";
                return false;                     
                }         
            }
        }
        else {
            document.getElementById("errorMessage").innerHTML="passord er ikke like";
            return false;
        }
    }
}

function ajaxCheck(name, email) {//sender forespørsel fila check.php som returnerer eller exception text eller null dersom alt er ok
    var query = "?name="+name+"&email="+email;
    //ajax område
    var xmlhttp;
    if (window.XMLHttpRequest)
    {// moderne nettlesere
        xmlhttp=new XMLHttpRequest();      
    }
    else
    {// gammelt ie
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    //sender forespørsel
    xmlhttp.open("GET","check.php"+query,false);
    xmlhttp.send(null);
    return xmlhttp.responseText;
}
