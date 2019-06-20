<template>
	<div class="trigger-button">
		<button class="button is-large is-success is-inverted is-outlined" @click="openReport">Make a Report</button>
		<div class="modal card-to-front" :class="{'is-active':report}">
	        <div class="modal-background" @click="cancel"></div>
	        <div class="modal-card for-mobile">
	            <header class="modal-card-head">
	                <p class="card-titling media-left">Report a Bad Road OR Traffic Area</p>
	                <button class="delete" @click='cancel' aria-label="close"></button>
	            </header>
	            <section class="modal-card-body">
	            	<div v-show="error" class="notification is-danger">
					  	<ul>
					      <li v-for="error in errors">{{ error }}</li>
					    </ul>
					</div>
					<div v-show="success" class="notification is-success">
					  	<ul class="has-icons-right">
					      	<li class="title">{{ success }}</li>
					      	<span class="icon is-small is-right">
					      		<i class="fas fa-check"></i>
					    	</span>
					    </ul>
					</div>
		            <form method="POST" enctype="multipart/form-data">
		            	<!-- first name -->
		            	<div class="field">
						  	<p class="control has-icons-left has-icons-right">
						    	<input class="input is-rounded" name="firstname" v-model="firstname" type="text" placeholder="First Name">
						    	<span class="icon is-small is-left">
						      		<i class="fas fa-user"></i>
						    	</span>
							    <span class="icon has-text-success is-small is-right" v-if="firstname" >
							      	<i class="fas fa-check"></i>
							    </span>
						  	</p>
						</div>
						<!-- last name -->
						<div class="field">
						  	<p class="control has-icons-left has-icons-right">
							    <input class="input is-rounded" name="lastname" v-model="lastname" type="text" placeholder="Last Name">
							    <span class="icon is-small is-left">
							      	<i class="fas fa-user"></i>
							    </span>
							    <span class="icon has-text-success is-small is-right" v-if="lastname" >
							      	<i class="fas fa-check"></i>
							    </span>
						  	</p>
						</div>
						<!-- email -->
						<div class="field">
						  	<p class="control has-icons-left has-icons-right">
							    <input class="input is-rounded" v-model="email" type="email" name="email" placeholder="Email">
							    <span class="icon is-small is-left">
							      	<i class="fas fa-envelope"></i>
							    </span>
							    <span class="icon has-text-success is-small is-right" v-if="email" >
							      	<i class="fas fa-check"></i>
							    </span>
						  	</p>
						</div>
						<!-- phone contact -->
						<div class="field">
						  	<p class="control has-icons-left has-icons-right">
							    <input class="input is-rounded" v-model.number="phone" type="number" name="phone" placeholder="Phone Contact">
							    <span class="icon is-small is-left">
							      	<i class="fas fa-phone"></i>
							    </span>
							    <span class="icon has-text-success is-small is-right" v-if="phone" @input="validatePhone" >
							      	<i class="fas fa-check"></i>
							    </span>
						  	</p>
						</div>
						<!-- state -->
						<div class="field">
						  	<p class="control has-icons-left has-icons-right">
							    <input name="state" v-model="state" class="input is-rounded" type="text" placeholder="State">
							    <span class="icon is-small is-left">
							      	<i class="fas fa-city"></i>
							    </span>
							    <span class="icon has-text-success is-small is-right" v-if="state" >
							      	<i class="fas fa-check"></i>
							    </span>
						  	</p>
						</div>
						<!-- city -->
						<div class="field">
						  	<p class="control has-icons-left has-icons-right">
							    <input name="city" v-model="city" class="input is-rounded" type="text" placeholder="City">
							    <span class="icon is-small is-left">
							      	<i class="fas fa-city"></i>
							    </span>
							    <span class="icon has-text-success is-small is-right" v-if="city" >
							      	<i class="fas fa-check"></i>
							    </span>
						  	</p>
						</div>

						<div class="field input-groupping">
							<div class="field control has-icons-left" style="margin-right:10px;">
								<!-- report type -->
								<div class="select is-rounded">
									<select v-model="reportOptions" name="option">
										<option disabled value="">Please select</option>
										<option value="badRoad">Report a Bad Road</option>
										<option value="trafficConditions">Report a Bad Traffic</option>
									</select>
								</div>
								<span class="icon is-small is-left">
								    <i class="fas fa-road"></i>
								</span>
							</div>
							<!-- upload image -->
							<div class="field control">
							  	<button class="button is-outlined is-success control has-icons-left" type="button" @click="upload">
								    Upload your Images
							  	</button>							  	
							</div>
						</div>
						<!-- location of incident -->
						<div class="field">
						  	<p class="control has-icons-left has-icons-right">
							    <input class="input is-rounded" v-model="location" type="text" name="location" placeholder="Location of Area">
							    <span class="icon is-small is-left">
							      	<i class="fas fa-road"></i>
							    </span>
							     <span class="icon has-text-success is-small is-right" v-if="location" >
							      	<i class="fas fa-check"></i>
							    </span>
						  	</p>
						</div>
						<!-- description -->
						<div class="field">
						  	<div class="control">
						    	<textarea class="textarea" name="description" v-model="description" placeholder="How bad is the Traffic Or Road ?"></textarea>
						  	</div>
						</div>
					</form>
	            </section>
	            <footer class="modal-card-foot field is-grouped is-grouped-right">
	                <button class="button is-success" @click="validate">Send Report</button>
	                <button class="button" @click="cancel">Cancel</button>
	            </footer>
	        </div>
	    </div>
	    <multiple-upload @finishedSelection="setUploads" :popUpload="uploadButton" @cancel="cancelUploadButton"></multiple-upload>
	</div>
</template>
<script>
	import MultipleUpload from './MultipleUpload.vue';

	export default {
		data() {
			return{
				uploadButton: false,
				report : false,
				firstname: '',
				lastname: '',
				email: '',
				phone: '',
				state: '',
				city: '',
				fermaUpload:[],
				reportOptions: '',
				location: '',
				description: '',
				errors: [],
				msg: '',
				error: false,
				success: false
			}
		},

		methods: {
			openReport(){
				this.report = true;
			},

			cancel(){
				this.report = false;
			},

			cancelUploadButton(){
				this.uploadButton = false;
			},

			validate(e){
				this.errors = [];

				if(!this.firstname){
					this.errors.push("First Name is Required");
				}

				if(!this.lastname){
					this.errors.push("Last Name is Required");
				}

				if(!this.email){
					this.errors.push("Email is Required");	
				}else if (!this.validateEmail(this.email)){
					this.errors.push("A valid email is required");
				}
				
				if(!this.phone){
					this.errors.push("A Phone Number is Required");
				}else if(!this.validatePhone(this.phone)){
					this.errors.push("A valid Phone Number is required");
				}
				

				if(!this.state){
					this.errors.push("State is Required");
				}

				if(!this.city){
					this.errors.push("City is Required");
				}

				if(!this.reportOptions){
					this.errors.push("Report Option is Required");
				}

				if(!this.location){
					this.errors.push("Location is Required");
				}

				if(!this.fermaUpload){
					this.errors.push("Please choose an image to upload");
				}

				if(!this.description){
					this.errors.push("A Discription is Required");
				}

				this.checkErrors(this.errors);
				
				if (!this.errors.length) {
					this.sendReport();
				}

				e.preventDefault();
			},

			upload(e){
				this.uploadButton = true;
			},

			sendReport(){
				let data = new FormData();

				data.append('firstname',this.firstname);
				data.append('lastname', this.lastname);
				data.append('email',this.email);
				data.append('phone', this.phone);
				data.append('state', this.state);
				data.append('city', this.city);
				data.append('reportOptions',this.reportOptions);
				data.append('location',this.location);
				data.append('description',this.description);

				this.fermaUpload.forEach(file => {
					data.append('fermaUpload[]', file);
				})
				

				axios.post('/report',data)
				.then((response) => {

					this.errors.push(response);
					this.firstname 		= '';
					this.lastname 		= '';
					this.email 			=  '';
					this.phone 			= '';
					this.state 			= '';
					this.city 			= '';
					this.fermaUpload 	= [];
					this.reportOptions 	= '';
					this.location 		= '';
					this.description	= '';

					this.msg = "Your upload is successful";
				}).catch((error) => {
					this.errors.push(error);
				});
			},

			validateEmail(email){
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

					return re.test(email);	
			},

			validatePhone(phone){

				var re = /^[0-9]{1,3}?[-\s.]?[0-9]{3}[-\s.]?[0-9]{4,7}$/gm;

				return re.test(phone);
			},

			sendSuccess(msg){

				if(msg && msg.length > 0){
					this.msg = msg;
					this.success = true;
					setTimeout(()=> {
						this.success = false;
					},5000)
				}
			},

			checkErrors(errors){

				if(errors && errors.length > 0){
					this.errors = errors;
					this.error = true;
					setTimeout(()=> {
						this.error = false;
					},5000)
				}
			},

			setUploads(file){
				this.fermaUpload = file;
				this.uploadButton = false;
			}
		},

		components: { MultipleUpload }
	}
</script>