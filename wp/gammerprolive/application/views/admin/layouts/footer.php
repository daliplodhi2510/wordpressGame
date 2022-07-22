        <div class="footer">
            <div class="pull-right">
                Developed by <a href="#">Brandzbix</a>
            </div>
            <div>
                <strong>Copyright</strong> Brandzbix &copy; <?php echo '2016 - '.date('Y'); ?>
            </div>
        </div>
    </div>
</div>
<?php include 'scripts.php'; ?>

<?php 
	# Remove search session data
	$this->session->unset_userdata('search');
?>
</body>
</html>
