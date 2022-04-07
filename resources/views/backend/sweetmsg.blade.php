<script>

    @if (isset($sweet_success)) 
        Swal.fire({
          icon: 'success',
          title: {{$msg}},
          confirmButtonText: 'Confirm'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = {{$link}};
          }
        })
      @endif
</script>