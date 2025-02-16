<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Docs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/5.11.3/swagger-ui.min.css">
</head>
<body>
    <div id="swagger-ui"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/5.11.3/swagger-ui-bundle.min.js"></script>
    <script>
        window.onload = function () {
            SwaggerUIBundle({
                url: "{{ url('/docs/api.yaml') }}",
                dom_id: "#swagger-ui",
            });
        };
    </script>
</body>
</html>
