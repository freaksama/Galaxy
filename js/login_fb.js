 // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    //console.log('statusChangeCallback');
    //console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().

   
            

    if (response.status === 'connected') {
      // Logged into your app and Facebook.

      //console.log(response);
      if(login=='N')
      {
        LoginFacebookMP();  
      }
      
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      //document.getElementById('status').innerHTML = 'Please log ' +       'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      //document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '794307344013409',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));



  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
    function LoginFacebookMP() 
    {
        FB.api('/me', function(response) {
            console.log(response);
            login_facebook_mypack(response.name,response.id);
            document.getElementById('status').innerHTML =
            'Thanks for logging in, ' + response.name + '!';
        });

    
  }

  function login_facebook_mypack(nombre,id)
    {
        dataString = 'opcion=login_facebook&nombre=' + nombre + '&id=' + id ;

        $.ajax({
            url: "ajax/ajax.php",
            data: dataString,
            async:true,
            beforeSend: function(ob){ /*$("#msj").html("<img src='img/load_05.gif' align='top' border='0' />");*/},
            complete: function (ob,exito){},
            dataType:"html",        
            global:true,
            success:function(data)
                    {
                        var r = jQuery.parseJSON(data);
                        
                        if(r.codigo=='000')
                        { 
                            location.reload();
                            //$("#tr_pen_"+id_inbox).fadeOut();
                        }
                        else
                        {
                            alert(r.mensaje); 
                            location.reload();        
                        }
                            
                    },
            timeout:5000,
            type:"POST"
        });
    }

    function salir_mypack()
    {
        if(confirm("Realmente desea cerra sesion?"))
        {
            FB.logout(function(response) {
              // user is now logged out
              alert("saliendo de facebook");
              return true;              
            });

            //setInterval(function(){ return true;},5000);         
            
        }
        else
        {
            return false;
        }
    }