@extends('component.layout')

@section('body')
    <div class="body">


        <div class="p+ logincard" flex-container="row" flex-column="12" style="padding-top: 10% !important;" ng-controller="login">
            <div flex-item="4"></div>
            <div class="p+++" flex-item="4">
                <div class="p++">
                    <form ng-submit="loginsubmit()">
                        <div class="card p+++">
                            <center><div class="text-field-error"><h4>[[result]]</h4></div></center>
                            @if (Session::has('message'))
                                <center><div class="text-field-error">{{ Session::get('message') }}</div></center>
                            @endif
                            <lx-text-field lx-label="Name" lx-fixed-label="true" lx-icon="email">
                                <input type="text" ng-model="form.username">
                            </lx-text-field>
                            <span class="text-field-error ml+++ pl+" ng-if="error.username">Email invalid</span>

                            <lx-text-field lx-label="Password" lx-fixed-label="true" lx-icon="lock">
                                <input type="password" ng-model="form.password">
                            </lx-text-field>
                            <span class="text-field-error ml+++ pl+" ng-if="error.password">password invalid</span>

                            <div class="pl+++ pt++">
                                <lx-checkbox ng-model="form.remember" lx-color="{{env('THEME')}}" class="ml"
                                             mx-tooltip="Remember me for next time">Remember me
                                </lx-checkbox>
                            </div>
                            <div class="p+ mt center-block">
                                <center>
                                    <lx-button lx-color="{{env('THEME')}}" lx-size="l" type="submit">Sign In</lx-button>
                                </center>



                                <center>
                                    <lx-button lx-color="{{env('THEME')}}" lx-type="flat" class="mt">Forget My Password
                                        ?
                                    </lx-button>
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div flex-item="4"></div>

        </div>
    </div>
@stop