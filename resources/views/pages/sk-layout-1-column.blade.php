
@php
  // confiData variable layoutClasses array in Helper.php file.
  $configData = Helper::applClasses();
  if($configData['mainLayoutType'] === 'horizontal-menu'){
    $layout = 'contentLayoutMaster';
  }
  else{
    $layout = 'fullLayoutMaster';
  }
@endphp

@extends('layouts.'.$layout)
{{-- title --}}
@section('title','1 Column')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">
@endsection

@section('content')
<!-- Description -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Description</h4>
    </div>
    <div class="card-body">
        <div class="card-text">
            <p>1 Column layout is very useful for full width page requirements i.e: Contact us, Terms & Condition, Privacy policy etc..., It has back link, navbar with inner starter page options and footer, navigation menu will not be displayed on this layout.</p>
        </div>
    </div>
</div>
<!--/ Description -->
<!-- CSS Classes -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">CSS Classes</h4>
    </div>
    <div class="card-body">
        <div class="card-text">
            <p>This table contains all classes related to the 1 column layout. This is a custom layout for full width page requirements.</p>
            <p>All these options can be set via following classes:</p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Classes</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><code>.1-column</code></th>
                            <td>You can create 1 column layout by adding <code>1-column</code> class in <code>&lt;body&gt;</code> tag.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--/ CSS Classes -->
<!-- HTML Markup -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">HTML Markup</h4>
    </div>
    <div class="card-body">
        <div class="card-text">
            <p>Please note that 1 column layout do not have Navigation section and it has back to Dashboard or Home page link in Navbar.</p>
            <p>Frest has a ready to use starter kit, you can use this layout directly by using the starter kit pages from the <code>frest-clean-bootstrap-admin-dashboard-template/starter-kit</code> folder.</p>
            <pre class="language-html">
    <code class="language-html">
        &lt;!DOCTYPE html&gt;
          &lt;html lang="en"&gt;
            &lt;head&gt;&lt;/head&gt;
            &lt;body class="vertical-layout vertical-menu-modern 1-column navbar-sticky footer-static" data-col="1-column" data-menu="vertical-menu-modern" &gt;

              &lt;!-- Fixed-top--&gt;
              &lt;nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-light navbar-shadow"&gt;
              &lt;/nav&gt;
              &lt;!-- End Fixed-top--&gt;
              &lt;!-- Begin Content--&gt;
              &lt;div class="app-content content"&gt;
                  &lt;div class="content-wrapper"&gt;
                  &lt;/div&gt;
              &lt;/div&gt;
              &lt;!-- End Content --&gt;
              &lt;!-- Start Footer Light --&gt;
              &lt;footer class="footer footer-static footer-light"&gt;
              &lt;/footer&gt;
              &lt;!-- End Footer light--&gt;

            &lt;/body&gt;
          &lt;/html&gt;
    </code>
    </pre>
        </div>
    </div>
</div>
<!--/ HTML Markup -->
@endsection
{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/ui/prism.min.js')}}"></script>
@endsection
