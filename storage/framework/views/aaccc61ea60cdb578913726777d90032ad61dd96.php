<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->make('layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<style>
		label{
			color: #ffffff;
		}
		#name-error, #email-error, #mobile-error, #first_name-error, #last_name-error, #mobile_no-error, #email_multiple-error, #description-error, #application_form_type-error, #subject-error, #declaration-error, #carbonate_email-error, #carbonate_secret_key-error{
			color: red;
		}
	</style>
</head>
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="d-flex flex-row flex-column-fluid page">

			
			<?php echo $__env->make('layouts.header_mobile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			<!--begin::Wrapper-->
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
				<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<!--begin::Entry-->
					<div class="d-flex flex-column-fluid">
						<!--begin::Container-->
						<div class="container">
						<?php $__env->startSection('content'); ?>
						<?php echo $__env->yieldSection(); ?>

						<!-- @yeild('content') -->
						</div>
						<!-- end::Container -->
					</div>
					<!--end::Entry-->
				</div>
				<!--end::Content-->
				<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>

	

	<!-- <script src=<?php echo e(asset('js/validate.js')); ?>></script> -->
</body>
</html>
<?php /**PATH E:\xampp\htdocs\shopper\resources\views/layouts/app.blade.php ENDPATH**/ ?>