<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    // List all leave requests
    public function index()
    {
        $leaveRequests = LeaveRequest::with('employee')->get();
        return response()->json($leaveRequests);
    }

    // Accept a leave request
    public function accept($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->status = 'accepted';
        $leaveRequest->save();

        return response()->json(['message' => 'Leave request accepted successfully', 'leave_request' => $leaveRequest], 200);
    }

    // Reject a leave request
    public function reject($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->status = 'rejected';
        $leaveRequest->save();

        return response()->json(['message' => 'Leave request rejected successfully', 'leave_request' => $leaveRequest], 200);
    }
}

