<template>
	<nav class="navbar is-primary is-large"  role="navigation" aria-label="main navigation">
	  	<div class="navbar-brand">
	    	<a class="navbar-item" href="#">
	      		<img src="/images/ferma_logo.png" width="112" height="28">
	    	</a>

	    	<a @click="setActive" 
	    		role="button" 
	    		class="navbar-burger burger" 
	    		:class="{'is-active':active}"
	    		aria-label="menu" 
	    		aria-expanded="false" 
	    		data-target="navbarBasicExample">

		      	<span aria-hidden="true"></span>
		      	<span aria-hidden="true"></span>
	      		<span aria-hidden="true"></span>
	    	</a>
	  	</div>

	  	<div id="navbarBasicExample" class="navbar-menu" :class="{'is-active':active}">
		    <div class="navbar-end">
		      	<div class="navbar-item">
		        	<div class="buttons">
		          		<a class="button is-primary" href="/register">
		            		<strong>Sign up</strong>
		          		</a>
		          		<a class="button is-light" href="/login">
		            		Log in
		          		</a>
		        	</div>
		      	</div>
		    </div>
	  	</div>
	</nav>
</template>

<script>
	export default{

		data(){
			return {
				active : false
			}
		},

		methods:{
			setActive(){
				this.active = !this.active
			}
		}
	}
</script>