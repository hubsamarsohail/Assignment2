<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{secure_asset('img/avatar5.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="/home"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-plus"></i> <span>Definitions</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            {{-- <li><a href="/lines">Lines</a></li> --}}
          {{-- <li><a href="/boxes">Boxes</a></li> --}}
          {{-- <li><a href="/circuit-breakers">Circuit Breakers</a></li> --}}
            {{-- <li><a href="/items">Items</a></li> --}}
          <li><a href="{{route('customers.index')}}">Customers / Vendors</a></li>
          <li><a href="{{route('product.index')}}">Products</a></li>
          <li><a href="{{route('vechile.index')}}">Vechiles</a></li>
          <li><a href="{{route('stock.index')}}">Stock</a></li>
          {{-- <li><a href="/kilowatt-pricing">Kilowatt Pricing</a></li> --}}
            {{-- <li><a href="#">Currency</a></li> --}}
            {{-- <li><a href="#">Item Fees</a></li> --}}
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-refresh"></i> <span>Transactions</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('invoice.purchase.index')}}">Purchase Invoice</a></li>
            <li><a href="{{route('invoice.sales.index')}}">Sales Invoice</a></li>
            <li><a href="{{route('invoice.sales.payment')}}">Sales Receipts</a></li>
            {{-- <li><a href="invoices">Invoices</a></li> --}}
            {{-- <li><a href="new-invoice">Generate Invoice</a></li> --}}
            {{-- <li><a href="create-invoice">Generate Invoices - Fixed Amount</a></li> --}}
            {{-- <li><a href="unpaid-invoice">Paid Invoice</a></li> --}}
            {{-- <li><a href="all-invoice">Fresh Invoices</a></li> --}}
            {{-- <li><a href="#">Expense</a></li> --}}
            {{-- <li><a href="#">Deposit</a></li> --}}
            {{-- <li><a href="counter-entry">Counter Entry</a></li> --}}
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-pencil"></i> <span>Delivery Notice</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('purchase-notice')}}">Purchase</a></li>
            <li><a href="{{route('sales-notice')}}">Sales</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-th-list"></i> <span>Reports</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('sales-report')}}">Sales Report</a></li>
            <li><a href="{{route('purchase-report')}}">Purchase Report</a></li>
            <li><a href="{{url('statement-account')}}">Statement Of Account</a></li>

            {{-- <li><a href="expense-report">Expense Report</a></li>
            <li><a href="profit-report">Net Profit Report</a></li>
            <li><a href="print-invoice">Print Invoice</a></li>
            <li><a href="pricing-report">Item Pricing</a></li>
            <li><a href="ampere-report">Item Ampere</a></li>
            <li><a href="profit-report-owner">Net Profit - Owners Report</a></li>
            <li><a href="no-counter-report">No Counter Invoice</a></li> --}}

          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-gear"></i> <span>Settings</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="{{url('currencies')}}">Currencies</a></li>
           
          </ul>
          <ul class="treeview-menu">
            <li><a href="{{url('currencies')}}">Currencies</a></li>
          
          </ul>
        </li>

        <li>
          <a href="#"
          href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="fa fa-power-off"></i> <span>Logout</span>
       </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
