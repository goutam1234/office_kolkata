(function() {
  // The width and height of the captured photo. We will set the
  // width to the value defined here, but the height will be
  // calculated based on the aspect ratio of the input stream.

  var width = 320;    // We will scale the photo width to this
  var height = 0;     // This will be computed based on the input stream

  // |streaming| indicates whether or not we're currently streaming
  // video from the camera. Obviously, we start at false.

  var streaming = false;

  // The various HTML elements we need to configure or control. These
  // will be set by the startup() function.

  var video = null;
  var canvas = null;
  var photo = null;
  var startbutton = null;
  var data_id = null;
       

  function startup() {
    video = document.getElementById('video1');
    canvas = document.getElementById('canvas1'); 
    photo = document.getElementById('photo1');
    startbutton = document.getElementById('startbutton1');
    
    

    navigator.mediaDevices.getUserMedia({video: true, audio: false})
    .then(function(stream) {
      video.srcObject = stream;
      video.play();
    })
    .catch(function(err) {
      console.log("An error occurred: " + err);
    });

    video.addEventListener('canplay', function(ev){
      if (!streaming) {
        height = video.videoHeight / (video.videoWidth/width);
      
        // Firefox currently has a bug where the height can't be read from
        // the video, so we will make assumptions if this happens.
      
        if (isNaN(height)) {
          height = width / (4/3);
        }
      
        video.setAttribute('width', width);
        video.setAttribute('height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);
        streaming = true;
      }
    }, false);

    // $(document).on('click',"#startbutton",function(ev){
    //     alert('kop');
    //     var data_id = $(this).data('button_id');
    //     alert(data_id);
    //     takepicture();
    //     ev.preventDefault();
    //   }, false);
      
    //   clearphoto();
    // })
    
    
    startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
      }, false);
      
      clearphoto();
    }

  // Fill the photo with an indication that none has been
  // captured.

  function clearphoto() {
    var context = canvas.getContext('2d');
    context.fillStyle = "#AAA";
    context.fillRect(0, 0, canvas.width, canvas.height);

    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
  }
  
  // Capture a photo by fetching the current contents of the video
  // and drawing it into a canvas, then converting that to a PNG
  // format data URL. By drawing it on an offscreen canvas and then
  // drawing that to the screen, we can change its size and/or apply
  // other changes before drawing it.

  function takepicture() {
    var context = canvas.getContext('2d');
    if (width && height) {
      canvas.width = width;
      canvas.height = height;
      context.drawImage(video, 0, 0, width, height);
      var canvas_data = canvas.toDataURL('image/png');
      $.ajax({
        url:base_url+"admin/payin/save_payin_expense_image",
        data: {"image":canvas_data},// Add as Data the Previously create formData
        type:"POST",
        cache:false,
        dataType:"json", // Change this according to your response from the server.
       
        error:function(err){
          clearphoto();
          $.alert({
            type: 'red',
            title: 'Alert!',
            content: 'Image Not Uploaded',
          });
        },
        success:function(data){

          if(data.status){
            
            photo.setAttribute('src', canvas_data);
            var button_id = startbutton.getAttribute('data-button_id');
            $("#expense_uploaded_img_"+button_id).show();
            $("#expense_uploaded_img_"+button_id).attr('src', base_url +'public/upload_image/temp_payin_images/'+data.image_link);
            $("#expense_uploaded_a_"+button_id).attr('href', base_url +'public/upload_image/temp_payin_images/'+data.image_link);
            $("#expense_image_"+button_id).val(data.image_link);
            $(".contentarea1").hide();
          } else {
            clearphoto();
            $.alert({
              type: 'red',
              title: 'Alert!',
              content: 'Image Not Uploaded',
            });
          }
        },
      });
    
    } else {
      clearphoto();
    }
  }

  // Set up our event listener to run the startup process
  // once loading is complete.
  $(document).on("click",".driver_shift",function(){
    startup();
  })
})();