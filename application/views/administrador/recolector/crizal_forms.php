<div class="page-title">
	<h3 class="breadcrumb-header">Form Elements</h3>
</div>
<!-- start page main wrapper -->
<div id="main-wrapper">
	<div class="row">
		<div class="col-md-6">
			<div class="card card-white">
				<div class="card-heading clearfix">
					<h4 class="card-title">Basic Form</h4>
				</div>
				<div class="card-body">
					<form>
						<div class="form-group">
							<label for="exampleInputEmail1">Email address</label>
							<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
							<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
						</div>
						<div class="form-group form-check">
							<input type="checkbox" class="form-check-input" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Check me out</label>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card card-white">
				<div class="card-heading clearfix">
					<h4 class="card-title">Horizontal Form</h4>
				</div>
				<div class="card-body">

					<form>
						<div class="form-group row">
							<label for="inputEmail3" class="col-xl-3 col-lg-4 col-form-label">Email</label>
							<div class="col-xl-9 col-lg-8">
								<input type="email" class="form-control" id="inputEmail3" placeholder="Email">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword3" class="col-xl-3 col-lg-4 col-form-label">Password</label>
							<div class="col-xl-9 col-lg-8">
								<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
							</div>
						</div>
						<fieldset class="form-group">
							<div class="row">
								<label class="col-form-label col-xl-3 col-lg-4 pt-0">Radios</label>
								<div class="col-xl-9 col-lg-8">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked="">
										<label class="form-check-label" for="gridRadios1">
											First radio
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
										<label class="form-check-label" for="gridRadios2">
											Second radio
										</label>
									</div>
									<div class="form-check disabled">
										<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled="">
										<label class="form-check-label" for="gridRadios3">
											Third disabled radio
										</label>
									</div>
								</div>
							</div>
						</fieldset>
						<div class="form-group row">
							<div class="col-xl-3 col-lg-4">Checkbox</div>
							<div class="col-xl-9 col-lg-8">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="gridCheck1">
									<label class="form-check-label" for="gridCheck1">
										Example checkbox
									</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-xl-9 col-lg-8 offset-xl-3 offset-lg-4">
								<button type="submit" class="btn btn-success">Sign in</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card card-white">
				<div class="card-heading clearfix">
					<h4 class="card-title">Inline Form</h4>
				</div>
				<div class="card-body">
					<form class="form-inline">
						<label class="sr-only" for="inlineFormInputName2">Name</label>
						<input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe">

						<label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
						<div class="input-group mb-2 mr-sm-2">
							<div class="input-group-prepend">
								<div class="input-group-text">@</div>
							</div>
							<input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
						</div>

						<div class="form-check mb-2 mr-sm-2">
							<input class="form-check-input" type="checkbox" id="inlineFormCheck">
							<label class="form-check-label" for="inlineFormCheck">
								Remember me
							</label>
						</div>

						<button type="submit" class="btn btn-primary mb-2">Submit</button>
					</form>
				</div>
			</div>

			
		</div>
	</div>
	<!-- Row -->
</div>
				
