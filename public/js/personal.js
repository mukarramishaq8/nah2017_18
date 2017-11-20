var ext;
function readURL(input) {
    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgViewer')
                .attr('src', e.target.result);

        };

        reader.readAsDataURL(input.files[0]);

       
	    var file = document.getElementById('imagePicker').files[0];
    	var res = file.name.split(".");
    	ext = res[1];
		if(file){
		   getAsText(file);
		}

    }
}
function save()
{
	
	var data = {

			'name': $('#name').val(),
			'gender':$('#gender').val(),
			'cNIC':$('#cNIC').val(),
			'email':$('#email').val(),
			'phoneNumber':$('#phoneNumber').val(),
			'emergencyPhoneNumber': $('#emergencyPhoneNumber').val(),
		};
		console.log(data);
	$.ajax({
		url:'/personalInformation/save',
		type: 'GET',
		data: data,
		dataType: 'json',
		success: function(data){

		},
		error: function(request, error){

		},

	});
}

function getAsText(readFile) {

  var reader = new FileReader();

  // Read file into memory as UTF-16
  reader.readAsText(readFile, "UTF-16");
  console.log(reader);
  reader
  // Handle progress, success, and errors
  reader.onprogress = updateProgress;
  reader.onload = loaded;
  reader.onerror = errorHandler;

}


function updateProgress(evt) {
  if (evt.lengthComputable) {
    // evt.loaded and evt.total are ProgressEvent properties
    var loaded = (evt.loaded / evt.total);
    if (loaded < 1) {
      // Increase the prog bar length
      // style.width = (loaded * 200) + "px";
    }
  }
}

function loaded(evt) {
  // Obtain the read file data
  var fileString = evt.target.result;
  // Handle UTF-16 file dump\
  var data = {

			"ext": ext,
		};
		console.log(data);
	$.ajax({
		url:'/personalInformation/saveImage',
		type: 'POST',
		data: data,
		dataType: 'json',
		success: function(data){

		},
		error: function(request, error){

		},

	});
}

function errorHandler(evt) {
  if(evt.target.error.name == "NotReadableError") {
    // The file could not be read
  }
}