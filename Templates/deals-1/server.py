#!/usr/bin/env python3
import http.server
import socketserver
import os

# Change to the directory containing the HTML file
os.chdir('/Users/nasimhayath/Apps/VueJs/deals/templates/deals-1')

PORT = 8000

class MyHTTPRequestHandler(http.server.SimpleHTTPRequestHandler):
    def end_headers(self):
        self.send_header('Cache-Control', 'no-cache, no-store, must-revalidate')
        self.send_header('Pragma', 'no-cache')
        self.send_header('Expires', '0')
        super().end_headers()

with socketserver.TCPServer(("", PORT), MyHTTPRequestHandler) as httpd:
    print(f"Server running at http://localhost:{PORT}/")
    print(f"Open http://localhost:{PORT}/index.html to view the homepage")
    print("Press Ctrl+C to stop the server")
    httpd.serve_forever()