<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="1;url=<?php echo esc_attr( $url ) ?>">
    <script type="text/javascript">
        window.location.href = <?php echo json_encode( $url ) ?>;
    </script>
    <title><?php _e( 'Page Redirection', 'ab' ) ?></title>
</head>
<body>
<?php printf( __( 'If you are not redirected automatically, follow the <a href="%s">link</a>.', 'ab' ), esc_attr( $url ) ) ?>
</body>
</html>