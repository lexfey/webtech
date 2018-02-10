<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 09.02.2018
 * Time: 11:34
 */
?>
@if(count($errors)>0)
	@foreach($errors->all() as $error)
	<div class='alert alert-danger'>
		<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
		{{$error}}
	</div>
	@endforeach
@endif
@if(session('success'))
	<div class="alert alert-success">
		{{session('success')}}
	</div>
@endif