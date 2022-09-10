@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Static Layout')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/vendors.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">
@endsection

@section('content')
<!-- Description -->
<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title">Description</h4>
    </div>
    <div class="card-body">
        <div class="card-text">
            <p>This table contains all classes related to the static layout. This is a custom layout classes for static layout page requirements.</p>
            <p>All these options can be set via following classes:</p>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Classes</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><code>.navbar-static</code></th>
                            <td>To set navbar static you need to add <code>navbar-static</code> class in <code>&lt;body&gt;</code> tag.</td>
                        </tr>
                        <tr>
                            <th scope="row"><code>.navbar-static-top</code></th>
                            <td>To set navbar static you need to add <code>navbar-static-top</code> class in <code>&lt;nav&gt;</code> tag.</td>
                        </tr>
                        <tr>
                            <th scope="row"><code>.menu-static</code></th>
                            <td>To set the main navigation static on page <code>menu-static</code> class needs to add in navigation wrapper.</td>
                        </tr>
                        <tr>
                            <th scope="row"><code>.footer-static</code></th>
                            <td>To set the footer static on page <code>footer-static</code> class needs to add in footer wrapper.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--/ Description -->
<!-- CSS Classes -->
<section id="css-classes" class="card">
    <div class="card-header">
        <h4 class="card-title">CSS Classes</h4>
    </div>
    <div class="card-body">
        <div class="card-text">
            <p>Default this template has a static layout elements, so there is no any specific classes need to add to create this layout.</p>
        </div>
    </div>
</section>
<!--/ CSS Classes -->
<!-- HTML Markup -->
<section id="html-markup" class="card">
    <div class="card-header">
        <h4 class="card-title">HTML Markup</h4>
    </div>
    <div class="card-body">
        <div class="card-text">
            <p>This section contains HTML Markup to create static layout. This layout has a navigation, content and left sidebar sections with common header & footer.</p>
            <p>Frest has a ready to use starter kit, you can use this layout directly by using the starter kit pages from the <code>frest-clean-bootstrap-admin-dashboard-template/starter-kit</code> folder.</p>
            <pre class="language-html">
            <code class="language-html">
                &lt;!DOCTYPE html&gt;
                  &lt;html lang="en"&gt;
                    &lt;head&gt;&lt;/head&gt;
                    &lt;body class="vertical-layout vertical-menu-modern 2-columns navbar-static menu-expanded" data-menu="vertical-menu-modern"&gt;

                      &lt;!-- Static-top--&gt;
                      &lt;nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-light navbar-shadow"&gt;
                          ...
                      &lt;/nav&gt;

                      &lt;!-- Begin Navigation--&gt;
                      &lt;div class="main-menu menu-static menu-light menu-accordion menu-shadow expanded"&gt;
                          ...
                      &lt;/div&gt;
                      &lt;!-- End Navigation--&gt;

                      &lt;!-- Begin Content--&gt;
                      &lt;div class="content app-content"&gt;
                          ....
                      &lt;/div&gt;
                      &lt;!-- End Content--&gt;

                      &lt;!-- Start Static Footer--&gt;
                      &lt;footer class="footer footer-static footer-light"&gt;
                          ...
                      &lt;/footer&gt;
                      &lt;!-- End Static Footer--&gt;

                    &lt;/body&gt;
                  &lt;/html&gt;
            </code>
            </pre>
        </div>
    </div>
</section>
<!--/ HTML Markup -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/ui/prism.min.js')}}"></script>
@endsection
