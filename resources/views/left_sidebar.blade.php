<div class="left-sidebar">
    <div class="calendar_container" ng-app="event_app" ng-controller="main_controller" ng-cloak>
        <h1 class="calendar_title">
            <span id="prev" ng-click="prev_month()">&#9668;</span>
            <%year%>.Gada <%month%>
            <span id="next" ng-click="next_month()">&#9658;</span>
        </h1>
        <table id="calendar" class="table">
            <tr id="header">
                <th class="text-center" ng-repeat="x in days_not"><%x%></th>
            </tr>
            <tr class="weeks" ng-repeat="y in date">
                <td 
                ng-repeat="z in y.days track by $index" 
                ng-class="{no_date : z == ''}" 
                ng-click="get_event(z)" 
                data-toggle="modal" 
                data-target="#event">
                    <a href="{{url('/')}}/calendar/<%active_year%>-<%active_month+1%>-<%z%>"
                        class="day" 
                        ng-class="{today : z == active_date && today_month == active_month && today_year == active_year}"
                        ng-if="z != ''"><%z%></span>
                </td>
            </tr>
        </table>
    </div>
</div>
<script src="{{url('/')}}/calendar/modules/main.js"></script>
<script src="{{url('/')}}/calendar/controllers/main.js"></script>