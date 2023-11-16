<!--begin::Footer-->
<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
	<!--begin::Container-->
	<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
		<!--begin::Copyright-->
		<div class="text-dark order-2 order-md-1">
			<span class="text-muted font-weight-bold mr-2">2023©</span>
			<a class="text-dark-75 text-hover-primary">Matchya</a>
		</div>
		<!--end::Copyright-->
		<!--begin::Nav-->
		<div class="nav nav-dark">
		</div>
		<!--end::Nav-->
	</div>
	<!--end::Container-->
</div>
<!--end::Footer-->

<!--end::Demo Panel-->

<!--begin::Page Scripts(used by this page)-->
<script src=<?php echo e(asset('assets/js/pages/widgets.js')); ?>></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script src=<?php echo e(asset('assets/js/common.js')); ?>></script>
<!-- <script src=<?php echo e(asset('js/validate-settings.js')); ?>></script> -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" 
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" 
        crossorigin="anonymous">
</script>
<!-- <script src=<?php echo e(asset('js/jquery.email.multiple.js')); ?>></script> -->

<script>
        function showDialog(id, name) {
            $("#modal-title").html("Are you sure want to Delete User Named " + name + "?");
            $("#modal-del-btn").attr("onclick", "$('#del-modal').modal('hide');event.preventDefault();document.getElementById(" + id + ").submit();");
            $('#del-modal').modal('show');
        }
        function showDialogAdmin(id,name){
            $("#modal-title").html("Are you sure want to Delete Admin Named "+name+"?");
            $("#modal-del-btn").attr("onclick","$('#del-modal').modal('hide');event.preventDefault();document.getElementById("+id+").submit();");
            $('#del-modal').modal('show');
        }
    </script>
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src=<?php echo e(asset('assets/plugins/global/plugins.bundle.js')); ?>></script>
    <script src=<?php echo e(asset('assets/plugins/custom/prismjs/prismjs.bundle.js')); ?>></script>
    <script src=<?php echo e(asset('assets/js/scripts.bundle.js')); ?>></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src=<?php echo e(asset('assets/plugins/custom/datatables/datatables.bundle.js')); ?>></script>
    <!--begin::Page Vendors(used by this page)-->
		<script src=<?php echo e(asset('assets/plugins/custom/flot/flot.bundle.js')); ?>></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		

    
    <script src=<?php echo e(asset('assets/js/pages/datatable/user-table.js')); ?>></script>
    
    
    <!--end::Global Theme Bundle-->
		<!--begin::Page Vendors(used by this page)-->
            
            <script src="<?php echo e(asset('assets/js/pages/crud/forms/validation/form-user-create.js')); ?>"></script>
    
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <!-- <script src="assets/js/pages/crud/datatables/advanced/column-visibility.js"></script> -->
    <!--end::Page Scripts-->
    

    <script>
	function openTab(evt, cityName) {
	var i, x, tablinks;
	x = document.getElementsByClassName("city");
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("tablink");
	for (i = 0; i < x.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" w3-blue", "");
	}
	
	document.getElementById(cityName).style.display = "block";
	evt.currentTarget.className += " w3-blue";

	localStorage.setItem('activeTab',cityName);
	}

    <?php if(request()->is('user')): ?>
	$( document ).ready(function() {
		var activeTab = localStorage.getItem('activeTab');
		if(activeTab){
		document.getElementById(activeTab).style.display = "block";
		var btn =  document.getElementById('btn-'+activeTab);
		btn.classList.add("w3-blue");
		// $('#btn-'.activeTab).addClass(" w3-blue"); 
		// evt.currentTarget.className += " w3-blue";
	}
	else{
		document.getElementById('pending').style.display = "block";
		var btn =  document.getElementById('btn-pending');
		btn.classList.add("w3-blue");   
	}
	});
    <?php endif; ?>

</script>
<!--end::Page Scripts--><?php /**PATH E:\xampp\htdocs\shopper\resources\views/layouts/footer.blade.php ENDPATH**/ ?>