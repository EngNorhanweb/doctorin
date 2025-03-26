<?php $__env->startSection('title'); ?>
<?php echo e($patient->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
	<div class="col">
		<div class="card shadow mb-4">
			<div class="card-body">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="card profile">
							<div class="card-body">
								<div class="text-center">
									<?php if(empty(!$patient->image)): ?>
									<img src="<?php echo e(asset('uploads/'.$patient->image)); ?>" alt="" class="rounded-circle img-thumbnail avatar-xl">
									<?php else: ?>
									<img src="<?php echo e(asset('img/patient-icon.png')); ?>" alt="" class="rounded-circle img-thumbnail avatar-xl">
									<?php endif; ?>
									<div class="online-circle">
										<i class="fa fa-circle text-success"></i>
									</div>
									<h4 class="mt-2"><?php echo e($patient->name); ?></h4>
									
									<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
									<a href="<?php echo e(route('patient.SendPassword', ['id' => $patient->id])); ?>" class="btn btn-doctorino btn-sm btn-round px-3"> <?php echo e(__('Send Credentials')); ?></a>
									<?php endif; ?>
									<?php if(auth()->user()->can('edit patient') || $patient->id == Auth::user()->id): ?>
									<a href="<?php echo e(route('patient.edit', ['id' => $patient->id])); ?>" class="btn btn-danger btn-sm btn-round px-3"> <i class="fa fa-pen"></i></a>
									<?php endif; ?>
									<ul class="list-unstyled list-inline mt-3 text-muted">
										<li class="list-inline-item font-size-13 me-3">
											<strong class="text-dark"><?php echo e($appointments->count()); ?></strong> <?php echo e(__('Appointments')); ?>

										</li>
										<li class="list-inline-item font-size-13">
											<strong class="text-dark"><?php echo e($invoices->count()); ?></strong> <?php echo e(__('Invoices')); ?>

										</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- end card -->
						<div class="table-responsive mt-2">
							<table class="table table-striped mb-0">
								<tbody>
									<tr>
										<th scope="row"><?php echo e(__('Contact No')); ?>:</th>
										<td> <?php echo e($patient->Patient->phone ?? __('N/A')); ?> </td>
									</tr>
									<tr>
										<th scope="row"><?php echo e(__('Email')); ?>:</th>
										<td> <?php echo e($patient->email ?? __('N/A')); ?> </td>
									</tr>
									<tr>
										<th scope="row"><?php echo e(__('Age')); ?>:</th>
										<td> <?php echo e(\Carbon\Carbon::parse($patient->Patient->birthday)->age); ?></td>
									</tr>
									<tr>
										<th scope="row"><?php echo e(__('Gender')); ?>:</th>
										<td> <?php echo e(__($patient->Patient->gender) ?? __('N/A')); ?> </td>
									</tr>
									<tr>
										<th scope="row"><?php echo e(__('Address')); ?>:</th>
										<td> <?php echo e($patient->Patient->adress ?? __('N/A')); ?> </td>
									</tr>
									<tr>
										<th scope="row"><?php echo e(__('Blood Group')); ?>:</th>
										<td> <?php echo e($patient->Patient->blood ?? __('N/A')); ?> </td>
									</tr>
									<tr>
										<th scope="row"><?php echo e(__('Weight')); ?>:</th>
										<td> <?php echo e($patient->Patient->weight ?? __('N/A')); ?> </td>
									</tr>
									<tr>
										<th scope="row"><?php echo e(__('Height')); ?>:</th>
										<td> <?php echo e($patient->Patient->height ?? __('N/A')); ?> </td>
									</tr>
									<tr>
										<th scope="row"><?php echo e(__('Registered On')); ?>:</th>
										<td> <?php echo e($patient->created_at ?? __('N/A')); ?> </td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-9 col-sm-6">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="Profile" aria-selected="true"><?php echo e(__('Health History')); ?></a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false"><?php echo e(__('Medical Files')); ?></a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="appointements-tab" data-toggle="tab" href="#appointements" role="tab" aria-controls="appointements" aria-selected="false"><?php echo e(__('Appointments')); ?></a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="prescriptions-tab" data-toggle="tab" href="#prescriptions" role="tab" aria-controls="prescriptions" aria-selected="false"><?php echo e(__('Prescriptions')); ?></a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="Billing-tab" data-toggle="tab" href="#Billing" role="tab" aria-controls="Billing" aria-selected="false"><?php echo e(__('Payment History')); ?></a>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							
								<div class="row my-4">
									<div class="col">
										<div class="card ">
											<div class="card-body">
												<form method="post" action="<?php echo e(route('history.store')); ?>">
														<div class="mb-1">
														<textarea name="note" class="form-control" rows="2" placeholder="<?php echo e(__('eg. blood pressure, medical background ...')); ?>"></textarea>
														<input type="hidden" name="patient_id" value="<?php echo e($patient->id); ?>">
														<?php echo e(csrf_field()); ?>

													</div>
													<button type="submit" class="btn btn-outline-primary w-lg mt-2 px-4"><?php echo e(__('Save')); ?></button>
												</form>
											</div>
										</div>
										<!-- end card -->
									</div>
								</div>
								<?php $__empty_1 = true; $__currentLoopData = $historys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
								<div class="alert alert-info">
									<p class="text- font-size-12">
										<?php echo clean($history->title); ?> <?php echo e($history->created_at); ?>

										<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete health history')): ?>
										<span class="float-right"><i class="fa fa-trash"  data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(route('history.destroy', ['id' => $history->id])); ?>"></i></span>
										<?php endif; ?>
									</p>
									<p><?php echo clean($history->note); ?></p>
								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								<div class="text-center mt-3"><img src="<?php echo e(asset('img/not-found.svg')); ?>" width="200" /> <br><br> <strong class="text-muted"><?php echo e(__('No health history was found')); ?></strong></div>
								<?php endif; ?>
							</div>
							<div class="tab-pane fade" id="appointements" role="tabpanel" aria-labelledby="appointements-tab">
								<div class="row">
									<div class="col">
										<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create appointment')): ?>
										<a type="button" class="btn btn-outline-primary btn-sm my-4 float-right" href="<?php echo e(route('appointment.create')); ?>"><i class="fa fa-plus mr-1"></i> <?php echo e(__('New Appointment')); ?></a>
										<?php endif; ?>
									</div>
								</div>
								<table class="table mt-3">
									<tr class="text-center">
										<th>Id</th>
										<th><?php echo e(__('Date')); ?></th>
										<th><?php echo e(__('Time Slot')); ?></th>
										<th><?php echo e(__('Status')); ?></th>
										<th><?php echo e(__('Actions')); ?></th>
									</tr>
									<?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
									<tr class="text-center">
										<td><?php echo e($appointment->id); ?> </td>
										<td><label class="badge badge-primary-soft"><i class="far fa-calendar"></i> <?php echo e($appointment->date->format('d M Y')); ?> </label></td>
										<td><label class="badge badge-primary-soft"><i class="far fa-clock"></i> <?php echo e($appointment->time_start); ?> - <?php echo e($appointment->time_end); ?> </label></td>
										<td>
											<?php if($appointment->visited == 0): ?>
											<label class="badge badge-warning-soft">
											<i class="fas fa-user-clock"></i> <?php echo e(__('Not Yet Visited')); ?>

											</label>
											<?php elseif($appointment->visited == 1): ?>
											<label class="badge badge-success-soft">
											<i class="fas fa-user-check"></i> <?php echo e(__('Visited')); ?>

											</label>
											<?php else: ?>
											<label class="badge badge-danger-soft">
											<i class="fas fa-user-times"></i> <?php echo e(__('Cancelled')); ?>

											</label>
											<?php endif; ?>
										</td>
										<td>
											<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit appointment')): ?>
											<?php if($appointment->date->isFuture() and $appointment->visited == 0): ?>
											<a class="btn btn-outline-info btn-sm"  href="<?php echo e(route('appointment.notify.whatsapp', ['id' => $appointment->id])); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Send Notification To Patient')); ?>"><i class="fab fa-whatsapp"></i></a>
											<a class="btn btn-outline-info btn-sm"  href="<?php echo e(route('appointment.notify.email', ['id' => $appointment->id])); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Send Notification To Patient')); ?>"><i class="far fa-envelope"></i></a>
											<?php endif; ?>
											<?php endif; ?>
											<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit appointment')): ?>
											<a data-rdv_id="<?php echo e($appointment->id); ?>" data-rdv_date="<?php echo e($appointment->date->format('d M Y')); ?>" data-rdv_time_start="<?php echo e($appointment->time_start); ?>" data-rdv_time_end="<?php echo e($appointment->time_end); ?>" data-patient_name="<?php echo e($appointment->User->name); ?>" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#EDITRDVModal"><i class="fas fa-check"></i></a>
											<?php endif; ?>
											<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete appointment')): ?>
											<a href="<?php echo e(route('appointment.destroy', ['id' => $appointment->id])); ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
											<?php endif; ?>
										</td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
									<tr class="text-center">
										<td colspan="5"><img src="<?php echo e(asset('img/not-found.svg')); ?>" width="200" /> <br><br> <strong class="text-muted"><?php echo e(__('No appointment available')); ?></strong></td>
									</tr>
									<?php endif; ?>
								</table>
							</div>
							<div class="tab-pane fade" id="prescriptions" role="tabpanel" aria-labelledby="prescriptions-tab">
								<div class="row">
									<div class="col">
										<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create prescription')): ?>
										<a class="btn btn-outline-primary btn-sm my-4 float-right" href="<?php echo e(route('prescription.create')); ?>"><i class="fa fa-pen mr-1"></i> <?php echo e(__('Write New Prescription')); ?></a>
										<?php endif; ?>
									</div>
								</div>
								<table class="table mt-3">
									<tr class="text-center">
										<th><?php echo e(__('Reference')); ?></th>
										<th><?php echo e(__('Content')); ?></th>
										<th><?php echo e(__('Created at')); ?></th>
										<th><?php echo e(__('Actions')); ?></th>
									</tr>
									<?php $__empty_1 = true; $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
									<tr class="text-center">
										<td><?php echo e($prescription->reference); ?> </td>
										<td> 
											<label class="badge badge-primary-soft">
											<?php echo e(count($prescription->Drug)); ?> Drugs
											</label>
											<label class="badge badge-primary-soft">
											<?php echo e(count($prescription->Test)); ?> Tests
											</label> 
										</td>
										<td><label class="badge badge-primary-soft"><?php echo e($prescription->created_at); ?></label></td>
										<td>
											<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view prescription')): ?>
											<a href="<?php echo e(route('prescription.view', ['id' => $prescription->id])); ?>" class="btn btn-outline-success btn-sm"><i class="fa fa-eye"></i></a>
											<?php endif; ?>
											<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit prescription')): ?>
											<a href="<?php echo e(route('prescription.edit', ['id' => $prescription->id])); ?>" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen"></i></a>
											<?php endif; ?>
											<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete prescription')): ?>
											<a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(route('prescription.destroy', ['id' => $prescription->id])); ?>"><i class="fas fa-trash"></i></a>
											<?php endif; ?>
										</td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
									<tr class="text-center">
										<td colspan="4"> <img src="<?php echo e(asset('img/not-found.svg')); ?>" width="200" /> <br><br> <strong class="text-muted"> <?php echo e(__('No prescription available')); ?></strong></td>
									</tr>
									<?php endif; ?>
								</table>
							</div>
							<div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
								<div class="row">
									<div class="col">
										<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
										<button type="button" class="btn btn-outline-primary btn-sm my-4 float-right" data-toggle="modal" data-target="#NewDocumentModel"><i class="fa fa-plus mr-1"></i> <?php echo e(__('Add New')); ?></button>
										<?php endif; ?>
									</div>
								</div>
								<div class="row mt-3">
									<?php $__empty_1 = true; $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
									<div class="col-md-4">
										<div class="card">
											<?php if($document->document_type == "pdf"): ?>
											<img src="<?php echo e(asset('img/pdf.jpg')); ?>" class="card-img-top" >
											<?php elseif($document->document_type == "docx"): ?>
											<img src="<?php echo e(asset('img/docx.png')); ?>" class="card-img-top" >
											<?php elseif($document->document_type == "MSG"): ?>
											<img src="<?php echo e(asset('img/msg.png')); ?>" class="card-img-top" >
											<?php elseif($document->document_type == "doc"): ?>
											<img src="<?php echo e(asset('img/docx.png')); ?>" class="card-img-top" >
											<?php elseif($document->document_type == "msg"): ?>
											<img src="<?php echo e(asset('img/msg.png')); ?>" class="card-img-top" >
											<?php elseif($document->document_type == "xlsx"): ?>
											<img src="<?php echo e(asset('img/xlsx.png')); ?>" class="card-img-top" >
											<?php elseif($document->document_type == "xls"): ?>
											<img src="<?php echo e(asset('img/xlsx.png')); ?>" class="card-img-top" >
											<?php elseif($document->document_type == "ppt"): ?>
											<img src="<?php echo e(asset('img/pptx.png')); ?>" class="card-img-top" >
											<?php elseif($document->document_type == "pptx"): ?>
											<img src="<?php echo e(asset('img/pptx.png')); ?>" class="card-img-top" >
											<?php else: ?>
											<a class="example-image-link" href="<?php echo e(url('/uploads/'.$document->file)); ?>" data-lightbox="example-1">
											<img src="<?php echo e(url('/uploads/'.$document->file)); ?>" class="card-img-top" width="209" height="209"></a>
											<?php endif; ?>
											<div class="card-body">
												<h5 class="style1"><?php echo e($document->title); ?></h5>
												<p class="font-size-12"><?php echo e($document->note); ?></p>
												<p class="font-size-11"><label class="badge badge-primary-soft"><?php echo e($document->created_at); ?></label></p>
												<a href="<?php echo e(url('/uploads/'.$document->file)); ?>" class="btn btn-primary btn-sm" download><i class="fa fa-cloud-download-alt"></i> <?php echo e(__('Download')); ?></a>
												<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(url('document/delete/'.$document->id)); ?>"><i class="fa fa-trash"></i></a>
											</div>
										</div>
									</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
									<div class="col text-center">
										<div class="text-center mt-3"><img src="<?php echo e(asset('img/not-found.svg')); ?>" width="200" /> <br><br> <strong class="text-muted"> <?php echo e(__('No document available')); ?> </strong></div>
									</div>
									<?php endif; ?>
								</div>
							</div>
							<div class="tab-pane fade" id="Billing" role="tabpanel" aria-labelledby="Billing-tab">
								<div class="row mt-4">
									<div class="col-lg-4 mb-4">
										<div class="card bg-primary text-white shadow">
											<div class="card-body">
												<?php echo e(__('Total With Tax')); ?>

												<div class="text-white small"><?php echo e(formatCurrency(Collect($invoices)->sum('total_with_tax'), get_option('currency_symbol'), get_option('currency_position'))); ?></div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 mb-4">
										<div class="card bg-success text-white shadow">
											<div class="card-body">
												<?php echo e(__('Already Paid')); ?>

												<div class="text-white small"><?php echo e(formatCurrency(Collect($invoices)->sum('deposited_amount'), get_option('currency_symbol'), get_option('currency_position'))); ?></div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 mb-4">
										<div class="card bg-danger text-white shadow">
											<div class="card-body">
												<?php echo e(__('Due Balance')); ?>

												<div class="text-white small"><?php echo e(formatCurrency(Collect($invoices)->where('payment_status','Partially Paid')->sum('due_amount'), get_option('currency_symbol'), get_option('currency_position'))); ?></div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice')): ?>
										<a type="button" class="btn btn-outline-primary btn-sm my-4 float-right" href="<?php echo e(route('billing.create')); ?>"><i class="fa fa-plus mr-1"></i> <?php echo e(__('Create Invoice')); ?></a>
										<?php endif; ?>
									</div>
								</div>
								<table class="table mt-3">
									<tr class="text-center">
										<th><?php echo e(__('Invoice')); ?></th>
										<th><?php echo e(__('Date')); ?></th>
										<th><?php echo e(__('Amount')); ?></th>
										<th><?php echo e(__('Status')); ?></th>
										<th><?php echo e(__('Transaction Number')); ?></th>
										<th><?php echo e(__('Actions')); ?></th>
									</tr>
									<?php $__empty_1 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
									<tr class="text-center">
										<td><a href="<?php echo e(route('billing.view', ['id' => $invoice->id])); ?>"><?php echo e($invoice->reference); ?></a></td>
										<td><label class="badge badge-primary-soft"><?php echo e($invoice->created_at->format('d M Y')); ?></label></td>
										<td> <?php echo e(formatCurrency($invoice->total_with_tax, get_option('currency_symbol'), get_option('currency_position'))); ?>

											<?php if($invoice->payment_status == 'Unpaid' OR $invoice->payment_status == 'Partially Paid'): ?>
											<label class="badge badge-danger-soft"><?php echo e(formatCurrency($invoice->due_amount, get_option('currency_symbol'), get_option('currency_position'))); ?> </label>
											<?php endif; ?>
										</td>
										<td>
											<?php if($invoice->payment_status == 'Unpaid'): ?>
											<label class="badge badge-danger-soft">
											<i class="fas fa-hourglass-start"></i>
											<?php echo e(__('Unpaid')); ?>

											</label>
											<?php elseif($invoice->payment_status == 'Paid'): ?>
											<label class="badge badge-success-soft">
											<i class="fas fa-check"></i> <?php echo e(__('Paid')); ?>

											</label>
											<?php else: ?>
											<label class="badge badge-warning-soft">
											<i class="fas fa-user-times"></i>
											<?php echo e(__('Partially Paid')); ?>

											</label>
											<?php endif; ?>
										</td>
										<td><label class="badge badge-danger-soft"><?php echo e(@$invoice->Transaction->transaction_id ?? 'N/A'); ?></label></td>
										<td>
											<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view invoice')): ?>
											<a href="<?php echo e(route('billing.view', ['id' => $invoice->id])); ?>" class="btn btn-outline-success btn-sm"><i class="fa fa-eye"></i></a>
											<?php endif; ?>
											<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit invoice')): ?>
											<a href="<?php echo e(route('billing.edit', ['id' => $invoice->id])); ?>" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen"></i></a>
											<?php endif; ?>
											<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice')): ?>
											<a href="<?php echo e(route('billing.destroy', ['id' => $invoice->id])); ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
											<?php endif; ?>
											<?php if(Auth::user()->role == 'patient' && $invoice->payment_status != 'Paid'): ?>
											<a href="<?php echo e(route('billing.pay', ['ref' => $invoice->reference])); ?>" class="btn btn-outline-danger btn-sm"><?php echo e(__('Pay Now')); ?></a>
											<?php endif; ?>
										</td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
									<tr class="text-center">
										<td colspan="6"><img src="<?php echo e(asset('img/not-found.svg')); ?>" width="200" /> <br><br> <strong class="text-muted"><?php echo e(__('No Invoices Available')); ?></strong></td>
									</tr>
									<?php endif; ?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Document Modal -->
<div id="NewDocumentModel" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Add File / Note')); ?></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<form method="post" action="<?php echo e(route('document.store')); ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" name="title" placeholder="<?php echo e(__('Title')); ?>" required>
							<input type="hidden" name="patient_id" value="<?php echo e($patient->id); ?>">
							<?php echo e(csrf_field()); ?>

						</div>
						<div class="col">
							<input type="file" class="form-control-file" name="file" id="exampleFormControlFile1" required>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col">
							<textarea class="form-control" name="note" placeholder="<?php echo e(__('Note')); ?>"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
					<button class="btn btn-outline-primary" type="submit"><?php echo e(__('Save')); ?></button>
			</form>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
<link rel="stylesheet" href="<?php echo e(asset('dashboard/css/lightbox.css')); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<script type="text/javascript" src="<?php echo e(asset('dashboard/js/lightbox.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.Auth::user()->role.'_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2.0/resources/views/patient/view.blade.php ENDPATH**/ ?>