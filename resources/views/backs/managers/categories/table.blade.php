@foreach($categories as $category)
    <tr>
        <th scope="row">{!! $category->id !!}</th>
        <td>{!! $category->name !!}</td>
        <td><img src="{!! isset($category->icon) ? asset($category->icon) : asset("images/category_default.png") !!}"
                 alt="{!! $category->name !!}" width="50"></td>
        {{--                        <td>{!! $provider->website !!}</td>--}}
        <td>

            <span class="checkbox-active">
                @if($category->status == true)
                    <button class="mb-2 mr-2 btn btn-success" disabled>
                        <i class="fas fa-check-circle"></i>
                    </button>
                @else
                    <button class="mb-2 mr-2 btn btn-danger" disabled>
                        <i class="fa fa-ban"></i>
                    </button>
                @endif
            </span>
        </td>
        <td>
            <a href="{{ route('categories.edit',$category->id) }}" target="_blank" class="mb-2 mr-2 btn btn-info"><i class="fas fa-edit"></i>
            </a>
            <a href="javascript:void(0);" class="mb-2 mr-2 btn btn-danger" onclick="deleteCategory(this,{{ $category->id }});"><i class="far fa-trash-alt"></i>
            </a>
        </td>
    </tr>
@endforeach
