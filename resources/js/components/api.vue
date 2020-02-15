<template>
    <div>
        <div class="row">
            <div class="col-auto">
                <h1>API</h1>
                <h4>By using the API you agree to the Attribution-NonCommercial-ShareAlike 4.0 International (CC
                    BY-NC-SA 4.0) license</h4>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <h3>Overwatch</h3>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-bordered bg-white">
                    <thead>
                    <tr style="font-weight: bold">
                        <td>Title</td>
                        <td>Today's Arcade</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>URL</td>
                        <td><a href="/api/overwatch/today">/api/overwatch/today</a></td>
                    </tr>
                    <tr>
                        <td>Method</td>
                        <td>GET</td>
                    </tr>
                    <tr>
                        <td>Notes</td>
                        <td>There is a is_today property to determine if it's today's arcarcade.</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-bordered bg-white">
                    <thead>
                    <tr style="font-weight: bold">
                        <td>Title</td>
                        <td>List all arcade modes</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>URL</td>
                        <td><a href="/api/overwatch/arcademodes">/api/overwatch/arcademodes</a></td>
                    </tr>
                    <tr>
                        <td>Method</td>
                        <td>GET</td>
                    </tr>
                    <tr>
                        <td>Notes</td>
                        <td>-</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h3>Overwatch 2</h3>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-bordered bg-white">
                    <thead>
                    <tr style="font-weight: bold">
                        <td>Title</td>
                        <td>Overwatch 2 today's arcade</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>URL</td>
                        <td><a href="/api/overwatch2/today">/api/overwatch2/today</a></td>
                    </tr>
                    <tr>
                        <td>Method</td>
                        <td>GET</td>
                    </tr>
                    <tr>
                        <td>Notes</td>
                        <td>There is a is_today property to determine if it's today's arcarcade.</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-bordered bg-white">
                    <thead>
                    <tr style="font-weight: bold">
                        <td>Title</td>
                        <td>List all arcade modes</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>URL</td>
                        <td><a href="/api/overwatch2/arcademodes">/api/overwatch2/arcademodes</a></td>
                    </tr>
                    <tr>
                        <td>Method</td>
                        <td>GET</td>
                    </tr>
                    <tr>
                        <td>Notes</td>
                        <td>-</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <h3>Contributors</h3>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-bordered bg-white">
                    <thead>
                    <tr style="font-weight: bold">
                        <td>Title</td>
                        <td>List all contributors</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>URL</td>
                        <td><a href="/api/users">/api/users</a></td>
                    </tr>
                    <tr>
                        <td>Method</td>
                        <td>GET</td>
                    </tr>
                    <tr>
                        <td>Notes</td>
                        <td>-</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-bordered bg-white">
                    <thead>
                    <tr style="font-weight: bold">
                        <td>Title</td>
                        <td>List all contributors</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>URL</td>
                        <td><a href="#">/api/user/:battletag</a></td>
                    </tr>
                    <tr>
                        <td>Method</td>
                        <td>GET</td>
                    </tr>
                    <tr>
                        <td>Notes</td>
                        <td>The hashtag in the battletag must be encoded. i.e bluedog#21410 -> bluedog%2321410</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "api"
    }
</script>