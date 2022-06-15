</div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0-rc
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./layout/wrapper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- AdminLTE App -->
<script src="./public/template/admin/dist/js/adminlte.min.js"></script>

<script>

      $(function() {
        $('#image').change(function () {
        var reader = new FileReader();

        reader.onload = function (e) {
          // get loaded data and render thumbnail.
          document.getElementById("product_img").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
      })
    });

    $(function() {
        $('#image_album').change(function () {
          var img = this.files;
          if(img.length === 1){
            var reader = new FileReader();
            reader.onload = function (e) {
              document.getElementById("album_product").src = e.target.result;
            };
            reader.readAsDataURL(img[0]);
          }
          else{
            for (let i = 0; i < img.length; i++) {
              var image = document.createElement('img');

              image.setAttribute('src', '');
              image.setAttribute('width', '100px');
              image.setAttribute('style', 'padding: 5px;');
              image.setAttribute('id', 'album_product'+i);
              
              var box = document.getElementById('box');
              box.appendChild(image);

              var reader = new FileReader();
              reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("album_product"+i).src = e.target.result;
              };
              reader.readAsDataURL(img[i]);
            }
          }
      })
    });
  
</script>
</body>
</html>
