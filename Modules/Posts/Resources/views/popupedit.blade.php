<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/23/2017
 * Time: 11:05 AM
 */
?>
<style>
    .modal-open .modal {
        display: flex !important;
        align-items: center;
        justify-content: center;
    }
</style>
<form action="#" id="form">
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label>Tên đăng nhập:</label>
                    <input type="text" placeholder="Tên đăng nhập" class="form-control" value="" readonly>
                </div>

                <div class="col-sm-6">
                    <label>Tên đầy đủ:</label>
                    <input type="text" placeholder="Tên đầy đủ" class="form-control" value="" name="fullname" id="fullname">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label>Ngày khởi tạo:</label>
                    <input type="text" placeholder="Ngày khởi tạo" class="form-control" value="" readonly>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Thuộc Group:</label>
                        <select multiple="multiple" class="select-border-color border-warning" name="group[]" id="group">
                            {{--@if(count($info['group'])>0)--}}
                                {{--@foreach($info['group'] as $item)--}}
                                    {{--@if($item['inGroup'] == 1)--}}
                                        {{--<option value="{{$item['GroupName']}}" selected>{!! $item['GroupName'] !!}</option>--}}
                                    {{--@else--}}
                                        {{--<option value="{{$item['GroupName']}}">{!! $item['GroupName'] !!}</option>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--@else--}}
                                {{--<option></option>--}}
                            {{--@endif--}}
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label>Lần cuối đăng nhập</label>
                    <input type="text" placeholder="Lần cuối đăng nhập" class="form-control" value="" readonly>
                </div>

                <div class="col-sm-6">
                    <label>Lần cuối thay đổi thông tin: </label>
                    <input type="text" placeholder="Lần cuối thay đổi thông tin" class="form-control" value="" readonly>
                </div>
            </div>
        </div>
    </div>
</form>