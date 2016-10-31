@extends('index')

@section('content')
    <div class="row" style="margin: 20px 100px;">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-8">

            <div class="panel-default">
                <div class="panel-heading">Order Details</div>
                <div class="row">
                    <div class="panel-body">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="condition" class="control-label">
                                    Customer Name</label><br>
                                <label style="color: rosybrown" for="Customer Name" class="control-label">
                                    Heshan</label>

                                {{--<input   id="price1"  name="priceFrom" type="number"
                                         placeholder="" class="form-control" required/>--}}
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="condition" class="control-label">
                                    Order ID</label>
                                {{--<label for="Customer Name" class="control-label">
                                    Heshan Perera</label>--}}

                                <input id="orderID" name="orderID" type="" value="652 "
                                       placeholder="" class="form-control" required/>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="condition" class="control-label">
                                    Order Date</label><br>
                                <label style="color: rosybrown" for="Customer Name" class="control-label">
                                    2016-12-20</label>

                                {{--<input   id="orderID"  name="orderDate" type=""
                                         placeholder="" class="form-control" required/>--}}
                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <h4>Items in the order</h4><br>

            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <table  class="table-bordered feedbackTable">

                        <tr>
                            <th >Item Name</th>
                            <th>Item Status</th>
                            <th>Add Review</th>
                            <th>Make Complain</th>

                        </tr>
                        <tr>
                            <td>Tata Indica Oil Filter</td>
                            <td><button class=" btn-default btn-block">Status</button></td>
                            <td><button data-toggle="modal" data-dismiss="modal" data-target="#modalReview" id="login_register_btn" class=" btn-default btn-block">Review</button></td>
                            <td><button class=" btn-default btn-block">Complain</button></td>


                        </tr>
                    </table>
                </div>

                <div class="col-sm-2"></div>

            </div>



        </div>
        <div class="col-sm-2">

        </div>
    </div>
    <br><br><br><br>

{{--
Review Modal
--}}

    <div class="modal fade bs-example-modal-lg"  id="modalReview" tabindex="-1" style="margin-top:120px;" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <img class="img-circle" width ="75px" height="75px"  src="Images/registerImage.png">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <br>
                    <div id="div-register-msg">
                        <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                        <span id="text-register-msg">Add a Review.</span>
                    </div>
                </div>
                <div class="modal-body">


                    <div class="container">
                        <div class="row" >
                            <div class="col-md-6">
                                <div class="well well-sm">
                                    <div class="stars starrr" data-rating="0"></div>
                                   {{-- <div class="text-right">
                                        <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
                                    </div>--}}

                                    <div class="row" id="post-review-box" >
                                        <div class="col-md-12">
                                            <form accept-charset="UTF-8" action="" method="post">
                                                <input id="ratings-hidden" name="rating" type="hidden" >
                                                <textarea class="form-control animated"  cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>

                                                <div class="text-right">
                                                    <div class="stars" data-rating="0"></div>
                                                    {{--<button class="btn btn-danger btn-lg"   style=" margin-right: 10px;">--}}
                                                        {{--Cancel</button>--}}
                                                    <button class="btn btn-success btn-lg" type="submit">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>





            </div>
        </div>
    </div>

@endsection

