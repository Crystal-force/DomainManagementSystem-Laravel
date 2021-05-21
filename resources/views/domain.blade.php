@extends('layout.index')
@section('content')

    <div class="main-menu">
        <header class="header">
            <a href="/dashboard" class="logo">DOMAIN SYSTEM</a>
            <button type="button" class="button-close fa fa-times js__menu_close"></button>
            @include('component.left-avater')
        </header>
        @include('component.left-menu')
    </div>


    <div class="fixed-navbar">
        <div class="pull-left">
            <button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
            <h1 class="page-title">Domain Management</h1>

        </div>

        <div class="pull-right">
          <a href="/logout" class="ico-item mdi mdi-logout"></a>
        </div>

    </div>


    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                <div class="col-lg-3 col-xs-12">
                    <div class="box-content bg-info text-white">
                        <div class="statistics-box with-icon">
                            <i class="ico small fa fa-external-link"></i>
                            <p class="text text-white">Domains</p>
                            <h2 class="counter">{{ $counts }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-xs-12">
                    <ul class="list-inline domain-add">
                        <li class="margin-bottom-10"><button type="button"
                                class="btn btn-success btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#add-domain">Add domain manually</button></li>
                        <li class="margin-bottom-10"><button type="button"
                                class="btn btn-violet btn-rounded waves-effect waves-light" onclick="GetDomainList()">Get
                                domains(API)</button></li>
                    </ul>
                </div>
            </div>

            <div class="row small-spacing">
                <div class="col-xs-12">
                    <div class="box-content">
                        <div class="row col-lg-12 domain-alert">
                            <div class="col-lg-6">
                                <div class="alert alert-success" role="alert" id="get_domainlist_success"> </div>
                            </div>
                        </div>
                        <h4 class="box-title">Domain Table</h4>
                        <!-- /.dropdown js__dropdown -->
                        <table id="example" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>User</th>
                                    <th>Created</th>
                                    <th>Expires</th>
                                    <th>IsExpired</th>
                                    <th>IsLocked</th>
                                    <th>AutoRenew</th>
                                    <th>WhoisGuard</th>
                                    <th>IsPremium</th>
                                    <th>IsOurDNS</th>
                                    <th>Detail Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($domains as $domain)
                                    @php
                                        $d = $domain['@attributes'];
                                    @endphp
                                    <tr>
                                        <td>{{ $d['ID'] }}</td>
                                        <td>{{ $d['Name'] }}</td>
                                        <td>{{ $d['User'] }}</td>
                                        <td>{{ $d['Created'] }}</td>
                                        <td>{{ $d['Expires'] }}</td>
                                        <td>{{ $d['IsExpired'] }}</td>
                                        <td>{{ $d['IsLocked'] }}</td>
                                        <td>{{ $d['AutoRenew'] }}</td>
                                        <td>{{ $d['WhoisGuard'] }}</td>
                                        <td>{{ $d['IsPremium'] }}</td>
                                        <td>{{ $d['IsOurDNS'] }}</td>
                                        <td>
                                            <span class="margin-bottom-10"><button type="button"
                                                    class="btn btn-warning btn-circle btn-xs waves-effect waves-light dns-btn"
                                                    data-toggle="modal" data-target="#domain-detail"
                                                    onclick="DNS_Detail(this)" data-id="{{ $d['Name'] }}"><i
                                                        class="menu-icon fa fa-eye"></i></button></span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-content -->
                </div>
                <div class="col-xs-12">
                    <div class="box-content">
                        <div class="row col-lg-12 domain-alert">
                            <div class="col-lg-6">
                                <div class="alert alert-success" role="alert" id="remove_domain_success"> </div>
                            </div>
                        </div>
                        <h4 class="box-title">Manually Domain Table</h4>
                        <!-- /.box-title -->
                        <div class="dropdown js__drop_down">
                            <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                            <ul class="sub-menu">
                                <li><a href="javascript:;" onclick="AllRemoveDomain()">All remove</a></li>
                            </ul>
                            <!-- /.sub-menu -->
                        </div>
                        <!-- /.dropdown js__dropdown -->
                        <table id="example" class="table table-striped table-bordered display" style="width:100%; text-align:center">
                            <thead>
                                <tr>
                                    <th style="text-align:center">ID</th>
                                    <th style="text-align:center">Name</th>
                                    <th style="text-align:center">Added Date</th>
                                    <th style="text-align:center">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($m_domains as $key=>$m_domain)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $m_domain->name }}</td>
                                        <td>{{ $m_domain->updated_at }}</td>
                                        <td>
                                          <button type="button" class="btn btn-danger btn-circle btn-xs waves-effect waves-light" data-id={{$m_domain->name}} onclick="RemoveManualDomain(this)"><i class="ico fa fa-remove (alias)"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-content -->
                </div>
            </div>

            <footer class="footer">
                @include('component.footer')
            </footer>
        </div>
    </div>

    <div class="modal fade" id="domain-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Domain Detail</h4>
                </div>
                <div class="modal-body" id="domain_detail_list">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm waves-effect waves-light"
                        data-dismiss="modal" onclick="CloseDomainDeatil()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-domain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Domain</h4>
                </div>
                <div class="modal-body">
                  <div class="alert alert-warning" role="alert" id="domainname_error"> </div>
                  <div class="alert alert-success" role="alert" id="add_domainlist_success"> </div>
                  <div class="alert alert-danger" role="alert" id="add_domainlist_false"> </div>
                  <h5 class="add-domainname"><b>Domain Full Name</b></h5>
                  <input type="text" class="form-control" maxlength="150" name="domainname" id="add_domain_name" placeholder="example.com"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm waves-effect waves-light"
                        data-dismiss="modal" onclick="CloseDomainDeatil()">Close</button>
                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light"
                    onclick="AddDomainManually()">Save</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function GetDomainList() {
            $("#get_domainlist_success").delay(5).fadeIn('slow').delay(1500).fadeOut('slow');
            $("#get_domainlist_success").html('<strong>Well done!</strong> The domain lists updated successfully.');
            setTimeout(function() {
                location.reload();
            }, 1500);
        }

        var domain_name;

        function DNS_SetDefault(elem) {
            domain_name = $(elem).attr('data-id');
            var domain = domain_name.split(".");
            var sld = domain[0];
            var tld = domain[1];

            var dns_domain_list = "";
            dns_domain_list += '<h5 class="add-domainname"><b>Domain Full Name</b></h5>\n' +
                '<input type="text" class="form-control" maxlength="25" name="domainname" id="domain_fullname" value="' +
                domain_name + '" placeholder="' + domain_name + '" readonly/>\n' +
                '<h5 class="add-domainname"><b>SLD</b></h5>\n' +
                '<input type="text" class="form-control" maxlength="25" name="sld" id="selected_sld" value="' + sld +
                '" placeholder="' + sld + '" readonly/>\n' +
                '<h5 class="add-domainname"><b>TLD</b></h5>\n' +
                '<input type="text" class="form-control" maxlength="25" name="tld" id="selected_tld" value="' + tld +
                '" placeholder="' + tld + '" readonly/>\n';

            $("#dns_domain").html(dns_domain_list);
        }


        var domain_detail = "";
        function DNS_Detail(elem) {
            domain_name = $(elem).attr('data-id');
            var domain = domain_name.split(".");
            var sld = domain[0];
            var tld = domain[1];

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/detail-domaininfo',
                method: 'post',
                data: {
                    sld: sld,
                    tld: tld
                },
                dataType: false,
                success: function(data) {
                  if(data.data == "false") {
                    domain_detail = '<p>Cannot complete this command as this domain is not using proper DNS servers</p>'
                    $("#domain_detail_list").html(domain_detail);
                  }
                  else {
                    var count = data.data.host.length;
                    for(var i=0; i<count; i++) {
                      domain_detail +='<div class="each-domain-list">\n'+ 
                                        '<p>Address: <span>"'+data.data.host[i]["@attributes"].Address+'"</span></p>\n'+
                                        '<p>AssociatedAppTitle: <span>"'+data.data.host[i]["@attributes"].AssociatedAppTitle+'"</span></p>\n'+
                                        '<p>FriendlyName: <span>"'+data.data.host[i]["@attributes"].FriendlyName+'"</span></p>\n'+
                                        '<p>HostId: <span>"'+data.data.host[i]["@attributes"].HostId+'"</span></p>\n'+
                                        '<p>IsActive: <span>"'+data.data.host[i]["@attributes"].IsActive+'"</span></p>\n'+
                                        '<p>IsDDNSEnabled: <span>"'+data.data.host[i]["@attributes"].IsDDNSEnabled+'"</span></p>\n'+
                                        '<p>MXPref: <span>"'+data.data.host[i]["@attributes"].MXPref+'"</span></p>\n'+
                                        '<p>Name: <span>"'+data.data.host[i]["@attributes"].Name+'"</span></p>\n'+
                                        '<p>TTL: <span>"'+data.data.host[i]["@attributes"].TTL+'"</span></p>\n'+
                                        '<p>Type: <span>"'+data.data.host[i]["@attributes"].Type+'"</span></p>\n'+
                                      '</div>';
                      $("#domain_detail_list").html(domain_detail);
                    }
                  }
                    
                }
            });
        }

        function AddDomainManually() {
          var domain_name = $('#add_domain_name').val();
          if(domain_name.indexOf('.') == -1) {
            $("#domainname_error").delay(5).fadeIn('slow').delay(1500).fadeOut('slow');
            $("#domainname_error").html('<strong>Warning</strong> Please insert correct domain name.');
          }
          
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
              url:'/add-domain-manually',
              method: 'post',
              data: {
                d_name: domain_name
              },
              dataType: false,
              success: function(data) {
                if(data.data == '1') {
                  $("#add_domainlist_success").delay(5).fadeIn('slow').delay(1500).fadeOut('slow');
                  $("#add_domainlist_success").html('<strong>Well done!</strong> The domain lists added successfully.');
                  setTimeout(function() {
                      location.reload();
                  }, 1500);
                }
                else if(data.data == "0") {
                  $("#add_domainlist_false").delay(5).fadeIn('slow').delay(1500).fadeOut('slow');
                  $("#add_domainlist_false").html('<strong>Oh snap!</strong> The domain already exist. please correct domain name.');
                }
              }
            });
          
        }


        function CloseDomainDeatil() {
          domain_detail= "";
          $("#domain_detail_list").html(domain_detail);
        }

        function RemoveManualDomain(elem) {
          var domain = $(elem).attr('data-id');
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
            url: '/remove-domain',
            method: 'post',
            data: {
              r_domain:domain
            },
            dataType:false,
            success: function(data) {
              if(data.data == "1") {
                $("#remove_domain_success").delay(5).fadeIn('slow').delay(1500).fadeOut('slow');
                $("#remove_domain_success").html('<strong>Well done!</strong> The domain remonved successfully.');
                setTimeout(function() {
                    location.reload();
                }, 1500);
              }
            }
          })
        }

        function AllRemoveDomain() {
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
          
          $.ajax({
            url: '/all-remove-domain',
            method: 'post',
            data: {
              all:'1'
            },
            dataType: false,
            success: function(data) {
              if(data.data == "1") {
                $("#remove_domain_success").delay(5).fadeIn('slow').delay(1500).fadeOut('slow');
                $("#remove_domain_success").html('<strong>Well done!</strong> The domain remonved successfully.');
                setTimeout(function() {
                    location.reload();
                }, 1500);
              }
            }
          })
        }

    </script>

@endsection
