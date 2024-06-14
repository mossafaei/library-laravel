<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Interfaces\BookRepositoryInterface;
use App\Http\Repositories\Interfaces\BorrowRepositoryInterface;
use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private BookRepositoryInterface $bookRepository;
    private BorrowRepositoryInterface $borrowRepository;

    public function __construct(UserRepositoryInterface $__userRepository, BookRepositoryInterface $__bookRepository, BorrowRepositoryInterface $__borrowRepository)
    {
        $this->userRepository = $__userRepository;
        $this->bookRepository = $__bookRepository;
        $this->borrowRepository = $__borrowRepository;
    }

    public function lend(Request $request)
    {
        if ($this->userRepository->checkUserHasBook($request->post('email'), $request->post('book_id')))
        {
            $this->borrowRepository->create(
                Auth::id(), 
                $this->userRepository->findWithEmail($request->post('email')), 
                $request->post('book_id')
            );
            
            $request->session()->flash('status', 'This book has been lent to the user successfully!');

            return redirect('/book/' . $request->post('book_id'));
        }

        $request->session()->flash('status', 'This book has been already lent to the user');

        return redirect('/book/' . $request->post('book_id'));
    }

    public function take(Request $request)
    {
        $this->borrowRepository->updateTimestamp(
            $request->post('book_id'), 
            $request->post('user_id'), 
            Carbon::now()
        );
        return back();
    }

    public function addUser(Request $request)
    {
        $this->userRepository->create(
            $request->post('name'), 
            $request->post('email'), 
            $request->post('email'), 
            $request->post('address'), 
            $request->post('phone_number')
        );

        $request->session()->flash('status', 'Item has been added successfully!');        
        
        return back();
    }

    public function showUser(Request $request, $id = null)
    {
        if ($id == null && $request->get('searchEmail')){
            return view('list/listuser', ['data' => $this->userRepository->searchWithEmail($request->get('searchEmail'))]);
        }else if ($id == null)
            return view('list/listuser', ['data' => $this->userRepository->findAll()]);

        return view('item/itemuser', [
            'data' => $this->userRepository->findWithId($id), 
            'borrows' => $this->userRepository->findAllPendingBorrows($id), 
            'id' => $id
        ]);
    }

    public function addBook(Request $request)
    {
        $this->bookRepository->create(
            $request->post('name'), 
            $request->post('description'), 
            $request->post('count')
        );

        $request->session()->flash('status', 'Item has been added successfully!');        
        
        return back();
    }

    public function showBook(Request $request, $id = null)
    {
        if ($id == null && $request->get('searchName')){

            return view('list/listbook', ['data' => $this->bookRepository->searchWithName($request->get('searchName'))]);
        
        }else if ($id == null)
            return view('list/listbook', ['data' => $this->bookRepository->getAll()]);
        
        $lend = $this->bookRepository->countAllAvailableBooks($id);
        return view('item/itembook', [
            'data' => $this->bookRepository->findWithId($id), 
            'lend' => $lend, 
            'borrows' => $this->bookRepository->findAllBorrowsForBook($id), 
            'id' => $id 
        ]);
    }

    public function showEditUser(Request $request, $id)
    {
        return view('edit/edituser', [
            'data' => $this->userRepository->findWithId($id), 
            'id' => $id 
        ]);
    }

    public function showEditBook(Request $request, $id)
    {
        return view('edit/editbook', [
            'data' => $this->bookRepository->findWithId($id), 
            'id' => $id 
        ]);
    }


    public function editUser(Request $request, $id)
    {
        $this->userRepository->edit(
            $id, 
            $request->post('name'), 
            $request->post('email'), 
            $request->post('address'),
            $request->post('phone_number')
        );

        return redirect("/user/$id");
    }

    public function editBook(Request $request, $id)
    {

        $this->bookRepository->edit(
            $id, 
            $request->post('name'), 
            $request->post('description')
        );

        return redirect("/book/$id");
    }

}
