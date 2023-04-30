<div>
                                <h4 class="card-title customTitle">Notes</h4>
                                <table id="w0" class='table table-striped table-bordered detail-view mb-2'>
                                <thead>
                                    <tr>
                                        <th class="thead">Notes</th>
                                        <th class="thead">Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($notes as $noteKey => $noteValue)
                                    <tr>
                                        <td>{{$noteValue->notes}}</td>
                                        <td>{{$noteValue->created_at}}</td>
                                    </tr>
                                    @empty
                                        No data found
                                    @endforelse
                                </table>
                            </div>