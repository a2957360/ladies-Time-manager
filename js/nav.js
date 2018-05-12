$(document).ready(function() {
	//responsive menu toggle
	$("#menutoggle i").click(function() {
		$('.xs-menu').toggleClass('displaynone');
		});
	$("#submenutoggle li").click(function() {
		$('.xs-menu').toggleClass('displaynone');
		});
	$("#visInvis").on('click',function() {
		
		});
	$("#visInvis").on('click', function(e) {
		e.preventDefault();
		console.log("hi");
		$('.buttonVis').toggleClass('buttonInVis');
		var $inp = $("#password");  
		$inp.attr('type') === 'password' ?  $inp.attr('type', 'text') : $inp.attr('type', 'password');
	});
	//add active class on menu
	$('#submenutoggle li').click(function(e) {
		e.preventDefault();
		$('li').removeClass('active');
		// $(this).addClass('active');
		$(this).toggleClass('active');
	});
//drop down menu	
	$(".drop-down").hover(function() {
			$('.mega-menu').addClass('display-on');
		});
		$(".drop-down").mouseleave(function() {
			$('.mega-menu').removeClass('display-on');
		});
		
//check email input correction begin
/*$( "#email" ).blur(function() {
  console.log("blur");
});*/
function checkEmail() {
  //console.log("blur");
  var email = $("#email").val();
  var reg = /^\w+@\w+(\.[a-zA-Z]{2,3}){1,2}$/;
  var stringAdd = "Please enter a valid email address. <br/>e.g. fella@example.com";
  var stringAdd2 = "";
  if(reg.test(email)===false){
	   $( "#email" ).removeClass( "emailBG" ).addClass( "inputErro" );
	   //$("#email").siblings().append(stringAdd);
	   $("#email").siblings().html(stringAdd);
	   //$(".infoAndInput p").css( "display", "block" );
	   //$(".infoAndInputErr").removeClass( "displaynoneinfo" ).addClass( "displayBlockinfo" );
	   $("#email").siblings().removeClass( "displaynoneinfo" ).addClass( "displayBlockinfo" );
	  }else{
	   $( "#email" ).removeClass( "inputErro" ).addClass( "emailBG" );
	   $("#email").siblings().html(stringAdd2);
	   //$(".infoAndInputErr").css( "display", "none" );
	   $("#email").siblings().removeClass( "displayBlockinfo" ).addClass( "displaynoneinfo" );
	}
  }
$( "#email" ).on(
  "blur", checkEmail
);
//check email input correction end ---------------------------------
//check password input correction begin
function checkPSWD(event) {
	event.preventDefault();
  var pswd = $("#password").val();
  var reg = /[A-Z]{1,}/;
  var reg2 = /[0-9]{1,}/;
  var reg3 = /^[a-zA-Z0-9]{8,20}$/;
  //var reg = /[A-Z]+\d+\w{8,}/;
  var stringAdd = "Must be 8 - 20 charactors include at least one uppercase letter and one number";
  var stringAdd2 = "";
  //if(reg.test(pswd)&&reg2.test(pswd)){
  if(reg.test(pswd)&&reg2.test(pswd)&&reg3.test(pswd)){
	  $( "#password" ).removeClass( "inputErro" );
	 $("password").siblings().html(stringAdd2); 
	 $("password").siblings().removeClass( "displayBlockinfo" ).addClass( "displaynoneinfo" );
	 }else{
	 $( "#password" ).addClass( "inputErro" );
	 $("password").siblings().html(stringAdd); 
	 $("password").siblings().removeClass( "displaynoneinfo" ).addClass( "displayBlockinfo" );
  }
}
$( "#password" ).on(
  "blur", checkPSWD
);
//check password input correction end -------------------------------
//if account and password not matched, pop out erro info begin ------
if(1==2){
	$(".forgetPassword").removeClass( "displaynoneinfo" );
	}else{
	$(".forgetPassword").addClass( "displaynoneinfo" );	
	}
//if account and password not matched, pop out erro info end --------
//more info options begin -------------------------------------------
$('select').each(function(){
	var $this = $(this); 
	var numberOfOptions = $(this).children('option').length;
	
	$this.addClass('select-hidden'); 
    $this.wrap('<div class="select"></div>');
    $this.after('<div class="select-styled"></div>');
	
	var $styledSelect = $this.next('div.select-styled');
    $styledSelect.text($this.children('option').eq(0).text());
	
	var $list = $('<ul />', {
        'class': 'select-options',
    }).insertAfter($styledSelect);
	
	for (var i = 0; i < numberOfOptions; i++) {
        $('<li />', {
			text: $this.children('option').eq(i).text(),
            rel: $this.children('option').eq(i).val()
        }).appendTo($list);
    }
	
	var $listItems = $list.children('li');
  
    $styledSelect.click(function(e) {
        e.stopPropagation();
        $('div.select-styled.active').not(this).each(function(){
            $(this).removeClass('active').next('ul.select-options').hide();
        });
        $(this).toggleClass('active').next('ul.select-options').toggle();
    });
	
	$listItems.click(function(e) {
        e.stopPropagation();
        //$styledSelect.text($(this).text()).removeClass('active');
		$styledSelect.text($styledSelect.siblings("select").attr("id")+": "+$(this).text()).removeClass('active');
		//$styledSelect.text($(this).text()).removeClass('active');
		$styledSelect.removeClass( "inputErro" );
		$styledSelect.parent("div").siblings("p").html("");
        $this.val($(this).attr('rel'));
        $list.hide();
        //console.log($this.val());
    });
	if($this.val()!=="hide"){
		console.log($this.val()+"aaaa");
		$styledSelect.text($styledSelect.siblings("select").attr("id")+": "+$this.val());
	}
  
    function hideList() {
        $styledSelect.removeClass('active');
        $list.hide();
		}
    $(document).click(
	hideList
    );
	$styledSelect.on(
	"blur", hideList);
	
	$("#frequency").siblings(".select-styled").attr({title:"days inbetween two period times."});
	$("#frequency").siblings(".select-options").attr({title:"days inbetween two period times."});
	
	$("#duration").siblings(".select-styled").attr({title:"How long your period time last."});
	$("#duration").siblings(".select-options").attr({title:"How long your period time last."});
	
	$("#lastTime").attr({title:"Your last period starts on:"});
	$("#lastTimeEnd").attr({title:"Your last period ends on:"});
	
	$("#colorOfBlood").siblings(".select-styled").attr({title:"What is your xxx like?"});
	$("#colorOfBlood").siblings(".select-options").attr({title:"What is your xxx like?"});
	
	$("#textureOfBlood").siblings(".select-styled").attr({title:"What is your xxx like?"});
	$("#textureOfBlood").siblings(".select-options").attr({title:"What is your xxx like?"});
	
	$("#typeOfBlood").siblings(".select-styled").attr({title:"What is your xxx like?"});
	$("#typeOfBlood").siblings(".select-options").attr({title:"What is your xxx like?"});
	
	$("#abnormalOfBlood").siblings(".select-styled").attr({title:"What is your xxx like?"});
	$("#abnormalOfBlood").siblings(".select-options").attr({title:"What is your xxx like?"});
});
//more info options end -------------------------------------------
//check mandatory value begin --------------------------------------
//var idDefined = "#frequency";
//var idDefined = "";

function checkMandaroty(idDefined) {
	//e.preventDefault();
	//e.stopPropagation();
	var $choosedValue = $(idDefined).val();
	var $inputStyle = $(idDefined).siblings(".select-styled");
	var $inputErroContainer = $(idDefined).parent("div").siblings("p");
	var stringAdd = "This is a mandatory option, please choose one.";
	var stringAdd2 = "";
	console.log($choosedValue);
	if($choosedValue==="hide"){
	   $inputStyle.addClass( "inputErro" );
	   $inputErroContainer.html(stringAdd);
	   //$(".infoAndInput p").css( "display", "block" );
	   //$(".infoAndInputErr").removeClass( "displaynoneinfo" ).addClass( "displayBlockinfo" );
	   $inputErroContainer.removeClass( "displaynoneinfo" ).addClass( "displayBlockinfo" );
	  }else{
	   $inputStyle.removeClass( "inputErro" );
	   $inputErroContainer.html(stringAdd2);
	   //$(".infoAndInputErr").css( "display", "none" );
	   $inputErroContainer.removeClass( "displayBlockinfo" ).addClass( "displaynoneinfo" );
	}
}

function checkLastTime(idDefined) {
  //console.log("lasttime");
  //e.preventDefault();
  //e.stopPropagation();
  var lastTime = $(idDefined).val();
  //var reg = /^\w+@\w+(\.[a-zA-Z]{2,3}){1,2}$/;
  var reg = /^(01|03|05|07|08|10|12){1}\-([0]{1}[1-9]{1}|[1-2]{1}[0-9]{1}|[3]{1}[0-1]{1}){1}\-(20){1}[8-9]{2}$/;
  var reg2 = /^(04|06|09|11){1}\-([0]{1}[1-9]{1}|[1-2]{1}[0-9]{1}|(30){1}){1}\-(20){1}[8-9]{2}$/;
  var reg3 = /^(02){1}\-([0]{1}[1-9]{1}|[1]{1}[0-9]{1}|[2]{1}[0-8]{1}){1}\-(20){1}[8-9]{2}$/;
//&&reg2.test(lastTime)&&reg3.test(lastTime)
  var stringAdd = "Please enter a valid date, e.g. 05-15-2017";
  var stringAdd2 = "";
  if((reg.test(lastTime)||reg2.test(lastTime)||reg3.test(lastTime))===false){
	  $(idDefined).addClass( "inputErro" );
	  $(idDefined).siblings("p").html(stringAdd);
	  $(idDefined).siblings("p").removeClass( "displaynoneinfo" ).addClass( "displayBlockinfo" );
	  }else{
	  $(idDefined).removeClass( "inputErro" );
	  $(idDefined).siblings("p").html(stringAdd2);
	  $(idDefined).siblings("p").removeClass( "displayBlockinfo" ).addClass( "displaynoneinfo" );  
	  }
}


//$("#duration").siblings(".select-styled").on(
//  "click", checkMandaroty
//);

$("#duration").siblings(".select-styled").click(
  // $(this).stopPropagation(), //for test purpose, not pop out as the document is ready
  //idDefined = "#frequency",checkMandaroty
  //checkMandaroty("#frequency"); //when there are parameter in bracket,it will execute imediately in this way.
  function(){
  checkMandaroty("#frequency");
  }
);
$("#lastTime").focus(
function(){
	checkMandaroty("#duration");
	}
);
$("#lastTimeEnd").blur(
  //$(this).stopPropagation(), //for test purpose, not pop out as the document is ready
  //idDefined = "#duration",
  function(){
  //checkMandaroty("#frequency");
  //checkMandaroty("#duration");
  checkLastTime("#lastTimeEnd");
  }
);
$("#lastTime").blur(
  function(){
  checkLastTime("#lastTime");
  }
);

$("#textureOfBlood").siblings(".select-styled").click(
function(){
	checkMandaroty("#colorOfBlood");
	}
);
$("#typeOfBlood").siblings(".select-styled").click(
function(){
	checkMandaroty("#textureOfBlood");
	}
);
$("#abnormalOfBlood").siblings(".select-styled").click(
function(){
	checkMandaroty("#typeOfBlood");
	}
);
$("#submit").click(
function(){
	checkMandaroty("#abnormalOfBlood");
	}
);

//check mandatory value end --------------------------------------
});


