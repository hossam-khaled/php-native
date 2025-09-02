</main>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="{{ url('assets/admin') }}/assets/dist/js/bootstrap.bundle.min.js" class="astro-vvvwv3sm"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" class="astro-vvvwv3sm"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js"
    integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous"
    class="astro-vvvwv3sm"></script> -->
<script src="{{ url('assets/admin') }}/js/dashboard.js" class="astro-vvvwv3sm"></script>

<script>
    jQuery(document).ready(function(){

        
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        <?php if( session_has('success')):?>
         toastr.success('{{ session_flash("success") }}', '{{ lang("admin.success") }}')
        <?php endif;?>
})
</script>
</body>

</html>

<?php
end_errors();
?>