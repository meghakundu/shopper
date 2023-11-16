<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
      </a>
      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/" class="nav-link px-2 text-secondary">Home</a></li>
        <li><a href="/orders" class="nav-link px-2 <?php if($_SERVER['REQUEST_URI'] === '/orders'): ?> text-white <?php else: ?> text-secondary <?php endif; ?>">Orders</a></li>
        <li><a href="/manage-transactions" class="nav-link px-2 <?php if($_SERVER['REQUEST_URI'] === '/manage-transactions'): ?> text-white <?php else: ?> text-secondary <?php endif; ?>">Transactions</a></li>
        <li><a href="/stocks" class="nav-link px-2 <?php if($_SERVER['REQUEST_URI'] === '/stocks'): ?> text-white <?php else: ?> text-secondary <?php endif; ?>">Stocks</a></li>
        <li><a href="/blogs" class="nav-link px-2 <?php if($_SERVER['REQUEST_URI'] === '/blogs'): ?> text-white <?php else: ?> text-secondary <?php endif; ?>">Blogs</a></li>
      </ul>

      <?php if(auth()->guard()->check()): ?>
        <?php echo e(auth()->user()->name); ?>

        <div class="text-end">
          <a href="<?php echo e(route('logout.perform')); ?>" class="btn btn-outline-light me-2">Logout</a>
        </div>
      <?php endif; ?>

      <?php if(auth()->guard()->guest()): ?>
        <div class="text-end">
          <a href="<?php echo e(route('login.perform')); ?>" class="btn btn-outline-light me-2">Login</a>
          <a href="<?php echo e(route('register.perform')); ?>" class="btn btn-warning">Sign-up</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</header><?php /**PATH E:\xampp\htdocs\shopper\resources\views/layouts/partials/navbar.blade.php ENDPATH**/ ?>