<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/javascript" href="uploadify.css" />
<script type="application/x-javascript" src="jquery-1.4.2.min.js"></script>
<script type="application/x-javascript" src="jquery.uploadify.v2.1.4.min.js"></script>
<script type="application/x-javascript" src="swfobject.js"></script>
<script type="application/x-javascript" src="../corner_brd_arredonda.js"></script>
<script type="application/x-javascript" src="../jquery-tooltip/jquery.tooltip.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#file_upload').uploadify({
    'uploader'  : 'uploadify.swf',
    'script'    : 'uploadify.php',
    'cancelImg' : 'fechar.png',
    'folder'    : 'uploads/',
    //'auto'      : true,
	'buttonText'  : 'Baixar Arquivo',
	//'displayData' : 'percentage',
	//fileExt'     : '*.jpg;*.gif;*.png',
    //'fileDesc'    : 'Image Files',
	'queueSizeLimit' : 20,
    //'queueID'        : 'queue',
	'multi'       : true,
	//'scriptAccess' : 'sameDomain',
	'simUploadLimit' : 20,//permite enviar mais de um arquivo ao mesmo tempo
	'removeCompleted' : false //matem o barra de status depois do upload se true 
	//'buttonImg'  : 'browse1.png'
	
  });
 // $('#sidebar').corner(); 
 $('#teste').tooltip({ 
    delay: 0, 
    showURL: false, 
    bodyHandler: function() { 
        return $("<img/>").attr("src", this.src); 
    } 
 });
 $('#teste1 a').tooltip({ 
 track: true, 
    delay: 0, 
    showURL: false, 
    showBody: " - ", 
    fade: 250 
	});
});
</script>

<style>

#sidebar {
	margin: 0px;
	width: 500px ;
	float:left;
	
}

#allfiles {
	float:right;
	margin:20px;
	width:420px;
	}

#loader {
	display:none;
	padding:0 0 0 20px;
	}

#allfiles ul {
	margin:0;
	padding:0;
	list-style:none;
	border-bottom:1px solid #ccc;
	border-right:1px solid #ccc;
	border-left:1px solid #eee;
}

#allfiles ul li {padding:8px 5px;border-top:1px solid #eee;}

.odd {background:#f9f9f9;}

.uploadifyQueue {
	margin-top:5px;
}
.uploadifyQueueItem {
	font-size: 11px;
	color:#333;
	padding:5px 5px;
	width:300px;
	background:#E9E9D1;
	border:1px solid #C0C0C0;
	}
.uploadifyError {
	margin:0px;
	color: #cc0000 !important;
}
.uploadifyError .uploadifyProgressBar {
	margin:0px;
	background-color: #cc0000 !important;
}
#sidebar .cancel {float:right;}
#sidebar .cancel a:link,
#sidebar .cancel a:visited,
#sidebar .cancel a:hover {
	padding:0 !important;
	margin:0 4px 0 0 !important;
	width:11px !important;
	background: transaparent !important;
}
.uploadifyProgress {
	margin:0px;
	background-color: #FFF;
	margin-top: 8px;
	width: 97%;
}
.uploadifyProgressBar {
	margin:0px;
	background-color: #A3C7D8;
	width: 1px;
	height: 5px;
}
#queue{
	float:right;
	margin-left:10px;
	}


/**************************************************** Fim do Upload *****************************/
  
  </style>
</head>

<body>
<div id="sidebar">
<p>
<input type="file" id="file_upload" name="file_upload">
<a href="javascript:$('#file_upload').uploadifyUpload();">Enviar</a> |    <a href="javascript:$('#file_upload').uploadifyCancel($('.uploadifyQueueItem').first().attr('id').replace('file_upload',''))">Cancelar upload</a>
</p>
<img id="teste" src="../jquery-rollover-tooltip/ttbg.jpg">
</div>
<a id="teste1" href="teste.php">teste do toolptip</a>
<div id="queue"></div>

</body>
</html>