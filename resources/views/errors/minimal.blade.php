<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>

        <style>
            html, body { height: 100%; margin: 0; padding: 0; overflow: hidden; }
            body {
                background-color: #1C274C; 
                background-image: 
                    linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px);
                background-size: 30px 30px; 
                font-family: Poppins, DM Sans, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; 
                color: #e0e0e0;
                display: flex; align-items: center; justify-content: center;
                text-transform: uppercase;
            }
            .blueprint-card {
                border: 2px solid #ffffff; padding: 40px;
                background-color: #161f3c; width: 100%; max-width: 600px;
                text-align: center; box-shadow: 10px 10px 0px rgba(0,0,0,0.3); 
                position: relative;
            }
            .blueprint-card::before, .blueprint-card::after {
                content: '+'; position: absolute; font-size: 20px; color: #ffffff;
            }
            .blueprint-card::before { top: 10px; left: 10px; }
            .blueprint-card::after { bottom: 10px; right: 10px; }

            .error-code {
                font-size: 80px; font-weight: bold; letter-spacing: 5px; margin: 0;
                color: #ffffff; text-shadow: 2px 2px 0px #000;
                border-bottom: 1px dashed #ffffff; display: inline-block;
                padding-bottom: 10px; margin-bottom: 20px;
            }
            .error-message {
                font-size: 18px; text-transform: uppercase; letter-spacing: 2px;
                margin-bottom: 30px; line-height: 1.5;
            }
            .btn-home {
                display: inline-block; padding: 12px 25px; margin: 5px;
                border: 1px solid #ffffff; color: #ffffff;
                text-decoration: none; font-weight: bold; text-transform: uppercase;
                transition: 0.3s; background: transparent;
            }
            .btn-home:hover {
                background-color: #ffffff; color: #1C274C; cursor: pointer;
            }
        </style>
    </head>
    <body>

        <div class="blueprint-card">
            <div class="error-code">@yield('code')</div>

            <div class="error-message">
                <span style="color: #fffb00; display:block; margin-bottom:10px; text-transform: uppercase;">@yield('message')</span>
                
                <div style="font-size: 12px; font-style: italic; color: #ccc; margin-bottom: 10px; text-transform: uppercase;">
                    @yield('description_italic')
                </div>
                
                <div style="font-size: 16px; font-weight: bold; text-transform: uppercase;">
                    @yield('description_bold')
                </div>
            </div>

            <div class="actions">
                @yield('buttons')
            </div>
        </div>

    </body>
</html>