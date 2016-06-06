<div class="navbar navbar-inverse navbar-fixed-top" style="margin-bottom: 0px;min-height: 10px;">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>    
    <!--a class="navbar-brand" href="index.php?u=<?=$_SESSION['s']['nombre_usuario'];?>"><img src="<?=$_SESSION['s']['avatar'];?>" style="width:48px" /> <?=$_SESSION['s']['nombre_usuario'];?></a-->
  </div>
  <div class="navbar-collapse collapse navbar-inverse-collapse">
    <ul class="nav navbar-nav">      
    	<!--li style="text-align:center;"><a href="registrar"><img src="img/new-32.png" width="32" /> Nuevo</a></li-->
      <li style="text-align:center;"><a href="dashboard"><img src="img/start-32.png" width="24" /> Dashboard</a></li>      
      <li style="text-align:center;"><a href="notificaciones"><img src="img/message-32.png" width="24" /><span id="lk_noti" class="badge"></span> Notificaciones</a></li>           
      <li style="text-align:center;"><a href="index.php?sub=inb&op=lis" ><img src="img/email-32.png" width="26" /> <span id="lk_inbox" class="badge"></span> Inbox </a></li>      
      <li style="text-align:center;"><a href="mas_vistos" ><img src="img/more-view-64.png"  width="24" />Mas visto</a></li>     
      <li style="text-align:center;"><a href="index.php?op=usuarios"><img src="img/users-48.png" width="24" /> Usuarios</a></li>     
      

      <li style="text-align:center;"><a href="subcuentas"><img src="img/adduser.png  " width="24" /> SubCuentas <img src="img/nuevo2.gif" /></a></li>     
      
        
      <li style="text-align:center;"><a href="config/cuenta"><img src="img/config-32.png" width="24" /> Configurar Cuenta  </a></li>  
      
      
      
    </ul> 
    
    <ul class="nav navbar-nav navbar-right">
    
      <li><a href="logout" onclick="salir_mypack()" ><img src="img/logout.png" width="24" /> Cerrar Sesi&oacute;n</a></li>
      
    </ul>
  </div>
</div>