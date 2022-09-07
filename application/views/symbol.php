<?php $this->load->view("header");?>
<div class="container">
  <h2>Fetch Company Symbol Details</h2>
  <?php echo validation_errors(); ?>
  <form action="<?php echo $this->config->item('base_url').'symbol/details'?>" id="symbol-frm" name="symbol-frm" method="POST">
  <div class="form-group">
      <label for="company_symbol">Company Symbol:</label>
      <input type="text" class="form-control" id="company_symbol" placeholder="Enter company symbol" name="company_symbol">    
    </div>    
    <div class="form-group">
      <label for="company_name">Company Name:</label>
      <input type="text" class="form-control" id="company_name" placeholder="Enter company name" name="company_name">    
    </div>
    <div class="form-group">
      <label for="start_date">Start Date:</label>
      <input type="text"readonly="true" id="start_date" name="start_date" class="form-control" placeholder="Start Date">    
    </div>
    <div class="form-group">
      <label for="end_date">End Date:</label>
      <input type="text" readonly="true" name="end_date" id="end_date" class="form-control" placeholder="End Date">    
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div> 
    <input class="submit" type="submit" value="SUBMIT" name="submit">
  </form>
</div>


<script>
  $(document).ready(function() {

  $("#symbol-frm").validate({
    rules: {
      company_symbol: {
        required: true,
        minlength:4
      },
      company_name: {
        required: true
      },
      start_date: {
        required: true
      },
      end_date: {
        required: true
      },
      email: {
        required: true,
        email:true
      }
    },

    });
});
</script>

<?php $this->load->view("footer");?>