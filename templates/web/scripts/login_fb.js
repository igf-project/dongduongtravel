function statusChangeCallback(response) {
	if (response.status === 'connected') {
	  //làm gì đó
	} else if (response.status === 'not_authorized') {
		console.log('Please log into this app.');
	} else {
		console.log('Please log into this app.');
	}
}
window.fbAsyncInit = function() {
	FB.init({
	  appId      : '1472013313106754',
	  xfbml      : true,
	  status     : true,
	  cookie     : true,
	  version    : 'v2.5'
	});
	/* FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	}); */
};

(function(d, s, id){
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) {return;}
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/en_US/sdk.js";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
