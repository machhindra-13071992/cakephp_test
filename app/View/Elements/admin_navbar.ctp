<?php 
if($this->Session->check('Auth.User')){
echo $this->Html->link( "Go to the Admin Dashboard",   array('controller'=>'users','action'=>'dashboard','admin'=>true) ); 
echo "<br>";
echo $this->Html->link( "Logout",   array('controller'=>'users','action'=>'logout','admin'=>true) ); 
}else{
echo $this->Html->link( "Login",   array('controller'=>'users','action'=>'login'),array('escape' => false) );
echo "<br>";
}
?>