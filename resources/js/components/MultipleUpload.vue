<template>
	<div class="modal card-to-front" :class="{'is-active':uploadImage}">
  		<div class="modal-background" @click="close"></div>
  		<div class="modal-card for-upload-mobile">
		   	<section class="modal-card-body uploader"
    				@dragenter="onDragEnter"
					@dragleave="onDragleave"
					@dragover.prevent
					@drop="onDrop"
					:class="{ dragging : isDragging, 'image-adjustment-on-upload' : (images.length) }"
					
    		>
    			<!-- <form method="POST" enctype="multipart/form-data"> -->
	      			<div v-if="!images.length">
						<p class="file-icon" style="margin-bottom:50px;">
		          			<i class="fas fa-upload"></i>
		        		</p>
		        		<p class="file-label" style="margin-bottom:20px;">
		          			click or drop your images
		        		 </p>
					  	<div>OR</div>
					  	<div class="file-inputs">
					  		<label for="file" @click="openFile"> Select an Image</label> 
				      		<input id="fileUpload" class="file-inputs" type="file" name="fermaUpload" multiple @change="processUpload" accept="image/*">
				      	</div>
	      			</div>

	      			<div class="tile is-ancestor" v-show="images.length">
	      				<span v-if="error">{{ this.error }}</span>
	      				<div class="tile is-parent" v-for="(image,index) in images" :key="index">	      					
	      					<div class="tile is-child box">
							  	<!-- <div class="tile is-child box"> -->
								    <figure class="image is-4by3">
								      <img :src="image" alt="`${image.name}`">
								    </figure>
								    <div class="content">
								      	<span class="subtitle" v-text="fermaUpload[index].name"></span><br>
								      	<span class="subtitle" v-text="fermaUpload[index].size"></span>
								    </div>
								    <button class="button is-danger is-medium is-outlined">remove</button>
							  	<!-- </div> -->
							</div>
	      				</div>
	      			</div>				
				<!-- </form> -->
    		</section>
    		<footer class="modal-card-foot">
                <button class="button is-success" @click="chosen">Done</button>
                <button class="button" @click="destroy">Cancel</button>
            </footer>
  		</div>
	</div>
</template>

<script>
	
	export default{
		props : ['popUpload'],

		data(){
			return {
				dragCount : 0,

				isDragging : false,

				uploadImage : false,

				fermaUpload : [],

				images : [],

				error : ''
			}
		},

		methods: {
			openFile(){
				$('#fileUpload').click();
			},

			close(e){
				this.uploadImage = false;
				this.$emit('cancel');
				e.preventDefault();
			},

			destroy(e){
				this.uploadImage = false;
				this.$emit('cancel');
				this.images = [];
				this.fermaUpload = [];
				e.preventDefault();
			},

			onDragEnter(e){
				e.preventDefault();
				this.dragCount++ ;

				this.isDragging = true;
			},

			onDragleave(e){
				e.preventDefault();
				this.dragCount-- ;

				if(this.dragCount <= 0)
					this.isDragging = false;
			},

			onDrop(e){
				e.preventDefault();
				e.stopPropagation();

				this.isDragging = false;

				const files = e.dataTransfer.files;

				Array.from(files).forEach(file => this.addImage(file));
			},

			addImage(file){
				//check if the file upload was an image
				if(!file.type.match('image.*')){
					this.$emit('errors',`${file.name} is not an image`);
				}

				//the actucal file to be sent to server
				this.fermaUpload.push(file);

				//get source for image preview
				let reader = new FileReader();

				reader.onload = (e) => {
					this.images.push(e.target.result);
				}

				reader.readAsDataURL(file);

				if(file.size > 3000000){
					this.error = "One or More of your Files is too large, max size is 3mb";
					return;
				}
			},

			processUpload(e){
				const files = e.target.files;

				Array.from(files).forEach(file => this.addImage(file));
			},

			chosen(){
				this.$emit('finishedSelection',this.fermaUpload);
				this.uploadImage = false;
			}
									
		},

		watch: {

			popUpload(value){
				this.uploadImage = !!value;
			}
		}
	}
</script>

<style  scoped>
	.uploader {
		width: 100%;
		background : #2196F3;
		color : #fff;
		padding : 40px 15px;
		text-align: center;
		border-radius: 10px;
		border : 3px solid #fff;
		font-size: 20px;
		position: relative;
		display: flex;
	    flex-direction: column;
	    justify-content: space-evenly;
	    align-items: center;
	}

	i {
		font-size:85px;
	}

	.file-inputs {
		width:200px;
		margin: auto;
		height: 68px;
		position : relative; 
	}

	.file-inputs label, .file-inputs input{
		background: #fff;
		color: #2196F3;
		width: 100%;
		position: absolute;
		left: 0;
		top: 0;
		padding: 10px;
		border-radius: 4px;
		margin-top: 7px;
		cursor : pointer;
	}

	.file-inputs input{
		opacity : 0;
		z-index : -1;
	}

	.dragging{
		background: #fff;
		color :#2196F3;
		border: 3px solid #2196F3;
	}

	.dragging input{
		background: #2196F3 !important;
		color :#fff !important;
	}
</style>