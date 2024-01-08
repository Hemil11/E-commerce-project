<div class="container mt-5">
    <div>
        @if (Auth::check())
            <div>
                <a href="{{ route('subscription') }}" class="btn btn-dark btn-sm position-relative"
                    style="float: left">subscription</i>
                    @if (Auth::user()->is_subscribe == 0)
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">subscribe
                        </span>
                    @elseif (Auth::user()->is_subscribe == 1)
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">Active
                        </span>
                    @elseif (Auth::user()->is_subscribe == 2)
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">cancelled
                        </span>
                    @endif
                </a>
            </div>
            <div class=" d-flex justify-content-end">
                @if (Auth::user()->user_type == 2)
                    <div>
                        <a href="{{ route('add.cart.page') }}" class="btn btn-primary  position-relative">
                            <i class="fa fa-shopping-cart"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ countofcart() }}
                            </span>
                        </a>
                    </div>
                @endif

                <div class="dropdown">
                    <button class="btn btn-defult  dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">

                        @if (Auth::user()->image == null)
                            <img src="{{ asset('blank-profile-picture-973460_640.webp') }}" height="30px"
                                width="30px" class="float-left rounded-circle">
                        @else
                            <img src="{{ asset('user_img/' . Auth()->user()->image) }}" height="30px" width="30px"
                                class="float-left rounded-circle">
                        @endif

                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item " href="{{ route('user.details') }}"><i
                                    class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;Details</a></li>
                        <li><a class="dropdown-item " href="{{ route('order.success') }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i></i>&nbsp;&nbsp;&nbsp;order</a></li>
                        @if (Auth()->user()->is_subscribe == 1)
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cancelModal"><i
                                        class="fa fa-sign-out"></i>&nbsp;&nbsp;&nbsp;subscription cancel</a></li>
                        @elseif (Auth()->user()->is_subscribe == 2)
                            <li><a class="dropdown-item " data-bs-toggle="modal" data-bs-target="#restoreModal"><i
                                        class="fa fa-sign-out"></i>&nbsp;&nbsp;&nbsp;Don't cancel subscription</a></li>
                        @endif
                        <li><a class="dropdown-item " href="{{ route('logout') }}"><i
                                    class="fa fa-sign-out"></i>&nbsp;&nbsp;&nbsp;Logout</a></li>
                    </ul>
                </div>
            </div>
        @endif
        <img src="{{ asset('logo_img/' . logoImage()) }}" height="100" width="150" class="mx-auto d-block">
        <h1 class="d-flex justify-content-center mt-4">
            Welcome to Our Website
        </h1>
    </div>
</div>

{{-- -- Modal -- --}}
<div class="modal fade" id="restoreModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restoreModalLabel">Subscription Restoration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to restore your subscription?
                    <br> we send you mail for more info....
                </p>
                <!-- Add any additional information or details here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('stop.cancel') }}" class="btn btn-primary">Confirm Restoration</a>
            </div>
        </div>
    </div>
</div>


  <div class="modal fade" id="cancelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Subscription Cancellation Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel your subscription?
                    <br> we send you mail for more info....
                </p>
                <!-- Add any additional information or details here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('sub.cancel') }}" class="btn btn-primary">Confirm Cancellation</a>
            </div>
        </div>
    </div>
</div>
