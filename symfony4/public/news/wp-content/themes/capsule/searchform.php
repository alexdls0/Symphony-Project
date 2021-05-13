<form name="searchform" class="searchform" action="<?php echo home_url('/') ?>" method="get">
  <input name="s" class="input-md" type="text" placeholder="Search here ..." title="Search here ..." value="<?php echo $_GET['s']; ?>" />
  <button class="search-popup-btn" type="submit">
  <i class="fa fa-search" aria-hidden="true"></i>
  </button>                                
</form>