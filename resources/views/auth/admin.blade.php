@extends('layouts.app')

@section('content')
<table border="1" style="width: 70%;">
    <colgroup>
        <col width="25%" />
        <col width="25%" />
        <col width="25%" />
        <col width="25%" />
    </colgroup>
    <thead>
    <tr>
        <td>회원명</td>
        <td>이메일</td>
        <td>패스워드</td>
        <td>관리</td>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $ls)
        <tr>
            <td><a href="/member/view/{{ $ls->id }}">{{ $ls->name }}</a></td>
            <td>{{ $ls->name }}</td>
            <td>{{ $ls->email }}</td>
            <td>{{ $ls->password }}</td>
            <td>
                <a href="/member/modify/{{ $ls->id }}">수정</a>
                <a href="/member/remove/{{ $ls->id }}">삭제</a>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <td colspan="5">
        {{ $list->links() }}
    </td>
    </tfoot>

</table>
@endsection
