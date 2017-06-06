<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>items</title>
</head>
<body>
	<div>
		<ul>
			@if(isset($items))
				@foreach($items as $item)
					<li>{{$item->item}}</li> 
					<form action="{{URL('items')}}/{{$item->id}}" method="post">
						<input type="hidden" name="_method" value="delete">
						{{csrf_field()}}
						<input type="submit" value="Delete Item">
					</form>

					<form action="{{URL('items')}}/{{$item->id}}" method="post">

						
						<div class="checkbox" >
							<label for="done"> Done </label>
								<input type="checkbox" name="done" id="done" class="form-control">
						</div>
					</form>

				@endforeach
			@endif
		</ul>
	</div>
	<div class="row">
	<div class="col-md-6 col-md-offset-6">
		<form action="" id="one" method="post">
				{{csrf_field()}}
				<div class="form-group">
					<label for="item">Item </label>
						<input type="text" name="item" id="item" class="form-control">
				</div>
				
				<div class="form-group">
						<input type="submit" name="saveItem" id="saveItem" value="saveItem" class="form-control">
				</div>
			
		</form>
	</div>
	</div>
</body>
</html>