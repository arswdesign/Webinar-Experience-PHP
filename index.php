<?php 
session_start();
include_once ('controle/cadastro.php');
include_once ('controle/consulta.php');
include_once ('controle/session.php');

$consulta = new consulta();
$cadastro = new cadastro();
$session = new session();;


date_default_timezone_set('America/Sao_Paulo');
$data_atual = date("Y-m-d H:i:s");

$rsw = $consulta->consultar("eventos","ativo",1);

if ($rsw){
	$id = $rsw["id"];
	$webinar = $rsw["src_evento"];
	$data_webinar = $rsw["data_evento"];
	$fim = $rsw["concluido"];
	$aovivo = $rsw["aovivo"];
	$bg_play = $rsw["bg_play"];
	$banner = $rsw["banner"];
	
	$dia_evento = substr($data_webinar,8,2);
	$mes_evento = substr($data_webinar,5,2);
	$ano_evento = substr($data_webinar,0,4);
	$hora_evento = substr($data_webinar,10,6);
	
	$data_webinar_en = $ano_evento."/".$mes_evento."/".$dia_evento." ".$hora_evento;
	$data = $dia_evento."/".$mes_evento." - ".$hora_evento." hrs";
	$titulo = utf8_encode($rsw["titulo_evento"]);
	$descricao = utf8_encode($rsw["descricao_evento"]);
	
	$session->setSession('evento',$id);
	
	
}else{
	$session->setSession('evento',"");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="">
<meta name="keywords" content=""> 
<meta name="author" content="Alex Santos - Especialista em Desenvolvimento WEB"> 

<title>Webinar - Xtreme Security</title>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="fonts/fonts.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.10.3.custom.css">
<link rel="stylesheet" type="text/css" href="css/flipclock.css" />

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="js/flipclock.js"></script>

<script>
	open_msg = function(msg){
		$("#msg_dialog").html(msg)
		$("#dialog").dialog("open");
	}
	
	jQuery.fn.reset = function () {
	  $(this).each (function() { this.reset(); });
	}

	$(document).ready(function(){
		$(document).bind("contextmenu",function(e){
			return false;
		});
		
		$("#submit").button();
		$("#submit_chat").button();
		$("#logout").button();

		chatReload();
	});
	
	
	logout = function(){
		 $.post("logout.php",
		 	function(data){
			 	location.reload();
		 	}
		 
		 )
	}	
	
	chatReload = function(){
			$('#chat').load('webinar_chat_list.php',  function() {
			$('#chat').scrollTop($("#chatHeight").height()); 
		});	
		setTimeout(chatReload,5000);
	}
	function enviaChat() {
		if ($('#mensagem').val()!= ""){
			$.post("enviaChat.php", $("#envia_chat").serialize(),
				function(data){				
					if (data){
						$('#mensagem').val("");
						$('#mensagem').focus();
						chatReload();
					}
				}
			)
		}
    }
	
  $(function() {

	  
	 $("#dialog").dialog({
		dialogClass: "no-close",
		draggable: false,
		modal: true,
		autoOpen: false,
		width: 300,
		buttons: [
			{
				text: "OK",
				click: function() {
						$(this).dialog("close");
				}
			}
		]
		

	}); 
	  
    var form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      name = $( "#name" ),
      email = $( "#email" ),
      allFields = $( [] ).add( name ).add( email ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
	
 	function resetTips(){
		tips.text("");
	}
	
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "O " + n + " deve ter entre " +
          min + " e " + max + " caracteres." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
	
	
 	function addUser() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );
	  resetTips();
 
      valid = valid && checkLength( name, "Nome", 3, 20 );
      valid = valid && checkLength( email, "E-mail", 6, 100 );
      valid = valid && checkRegexp( email, emailRegex, "Opa! o e-mail está errado, tente alguma coisa como ui@desec.com" );
 
      if ( valid ) {
        $.post("cadastroWebinar.php", $("#form_cadastro").serialize(),
			function(data){
				var acao = $('#acao').val();	
				if (data){
					ga('send', 'event', 'WEBINAR','Cadastro Realizado ', acao);
				}
				location.reload();
			}
		)
      }
      return valid;
    }

	form = $("#form_cadastro").on( "submit", function( event ) {
      event.preventDefault();
      addUser();
    });
	
	form_chat = $("#envia_chat").on( "submit", function( event ) {
      event.preventDefault();
      enviaChat();
    });
	
  });
  </script>


</head>

<body>

<?php include_once 'controle/analyticstracking.php'; ?>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="dialog" title="Mensagem">
	<div id="msg_dialog"></div>
</div>

<div class="topo">
    <div class="left">
        <img src="imgs/logo_webinar.png"/>
    </div>
	<div class="right"><a href="https://br.linkedin.com/in/arswdesign" target="_blank"><img src="imgs/logo_wars.png"/></a></div>
    <div class="clr"></div>	
</div>

<div class="line_header"></div>

<div class="main">

	<?php if (!$rsw){?>
        <div class="clr" style="height:50px"></div>
        <div class="content3"> 
         <center style="margin:100px 0">
             <a href="http://xtremesecurity.com.br"><img src="imgs/logo_xtreme.png" /></a>
             <br />
            <h2> NENHUM EVENTO ATUALMENTE</h2>
            </center>
        	
        </div>
    <?php }else{?>
        
	<div class="bg_content bg_img">
    	
       
        
        <div class="content3"> 
        <div class="clr" style="height:50px"></div> 
            <div class="left" style="width:600px"> 
                <h1 class="laranja"><?php echo $titulo; ?><br />
                <span class="cinza"><?php echo $data; ?></span></h1>	
                <h2><?php echo $descricao; ?></h2>
                
            </div>   
			<div class="right" style="margin-right:10px;">
           	 <a href="http://xtremesecurity.com.br" target="_blank"><img src="imgs/logo_xtreme.png" /></a>
            </div>     
            <div class="clr" style="height:20px"></div>   
        </div>
        <div class="content2"> 
            <?php if($fim){ ?>
            <center>
            O Webinar terminou!
            <br /><br />
			<img width="660" height="371" src="imgs/<?php echo $bg_play; ?>">
            </center>
            
			
			<?php }else if($aovivo){ ?>
                	<?php if (!$_SESSION["validChat"]){  ?>
                    <div class="left">
                        <img width="660" height="371" src="imgs/<?php echo $bg_play; ?>">
                        <div class="clr" style="height:20px"></div>
                    </div>
                    <div class="left" style="padding-left:15px">
                        
                        <h2>PARTICIPE DO CHAT</h2>
                        <div class="cadastro_chat">
                            <form class="form_curso" id="form_cadastro" style="width:180px">
                            <fieldset>
                              <label for="name">Nome</label>
                              <input type="text" name="name" id="name" value="<?php echo $_SESSION["nome"]; ?>" class="text ui-widget-content ui-corner-all">
                              <label for="email">E-mail</label>
                              <input type="text" name="email" id="email" value="<?php echo $_SESSION["email"]; ?>" class="text ui-widget-content ui-corner-all">
                              <input type="hidden" name="acao" id="acao" value="cadastro_webinar" class="text ui-widget-content ui-corner-all">
                              <input type="submit" id="submit" value="CONTINUAR">
                            </fieldset>
                            </form>
                            <div style="width:200px; margin-top:10px" class="validateTips"></div>
                        </div>
                    </div>
                    
					<?php }else{?>
                    
                    
                    <div class="left">
                        <iframe width="660" height="371" src="<?php echo $webinar; ?>?rel=0&amp;controls=0&amp;showinfo=0"  frameborder="0" allowfullscreen></iframe>
                        <div class="clr" style="height:20px"></div>
                        <img width="660" height="80" src="imgs/<?php echo $banner; ?>"/>
                    </div>
                    <div class="left" style="padding-left:15px">
                    
                    	<div class="left" style="width:100px; margin-top:-20px"><h2>PARTICIPE DO CHAT</h2></div>
                        <div class="right"><input type="button" id="logout" value="SAIR" onclick="logout();"></div>
                        <div class="clr"></div>   
                        <div class="area_chat" id="chat">    
                        </div>
                        <div class="">
                          <form class="form_curso" id="envia_chat" style="width:220px">
                          <textarea id="mensagem" name="mensagem" class="textarea" placeholder="Digite sua mensagem" ></textarea>
                          <div class="right"><input type="submit" id="submit_chat" value="ENVIAR"></div>
                          </form>
                        </div>
                     </div>  
                    <?php }?>
                
                
            <?php }else{?>
            <center>
            <div class="clr" style="height:100px"></div>
            
            O WEBINAR AINDA NÃO COMEÇOU
            <div class="clr" style="height:20px"></div>
            <script type="text/javascript">
				var clock;
				
				$(document).ready(function() {
					// Set dates.
					var futureDate  = new Date("<?php  echo $data_webinar_en; ?>");
					var currentDate = new Date();
	
					// Calculate the difference in seconds between the future and current date
					var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;
	
					// Calculate day difference and apply class to .clock for extra digit styling.
					function dayDiff(first, second) {
						return (second-first)/(1000*60*60*24);
					}
	
					if (dayDiff(currentDate, futureDate) < 100) {
						$('.clock').addClass('twoDayDigits');
					} else {
						$('.clock').addClass('threeDayDigits');
					}
	
					if(diff < 0) {
						diff = 0;
					}
	
					// Instantiate a coutdown FlipClock
					clock = $('.clock').FlipClock(diff, {
						countdown: true,
						clockFace: 'HourlyCounter',
						callbacks: {
							stop: function() {
								window.location.reload()
							}
						}
					});
					
				});
			 </script>
            </center> 
             <div class="clock" style="width:500px;"></div>
              <div class="clr" style="height:100px"></div> 
             
			<?php }?>
            <div class="clr" style="height:10px"></div>  
        </div>   
      <div class="clr" style="height:50px"></div> 

    </div>
	<?php }?>
</div>

</body>
</html>
