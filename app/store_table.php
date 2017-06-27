<?php

echo "store table";

?>
            <div class="btn-group" data-ng-class="{open: open}">
                <button class="btn">Filter by Company</button>
                <button class="btn dropdown-toggle" data-ng-click="open=!open"><span class="caret"></span>

                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                    <li><a data-ng-click="checkAll()"><i class="icon-ok-sign"></i>  Check All</a>

                    </li>
                    <li><a data-ng-click="selectedCompany=[];"><i class="icon-remove-sign"></i>  Uncheck All</a>

                    </li>
                    <li class="divider"></li>
                    <li data-ng-repeat="company in companyList"> <a data-ng-click="setSelectedClient()">{{company.name}}<span data-ng-class="isChecked(company.id)"></span></a>

                    </li>
                </ul>
            </div>
        </li>
    </ul>
    <hr/>
     <h3>Clients Table:</h3>

    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th style="width:10%">#</th>
                <th style="width:20%">Name</th>
                <th style="width:40%">Designation</th>
                <th style="width:30%">Company</th>
            </tr>
        </thead>
    </table>