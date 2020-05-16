# PPHP Symfony application for tasks todo.
Proposed User Story: 
"As a user, I want to have an ability to see a list of tasks for my day, so that I can do them one by one".

# Domain
- Task
	- id
	- name
	- status (completed/remaning)
	- createdAt
	- updatedAt
- Factory
	- TaskFactory
		- > createFromName
- Exception
	- TaskNameIsEmptyException
	- TaskNameIsAlreadyExistedException
	- TaskIsNotFoundException
- Specification
	- TaskNameIsNotEmptySpecification
		- > isSatisfiedBy 
	- TaskNameIsUniqueSpecification
		- > isSatisfiedBy 
- Repository
	- TaskRepositoryInterface
 		- > findAll
 		- > find
 		- > findAllByStatus
 		- > findByName
		- > save
		- > remove
 		
# Application
- Task
	- Exception
		- TaskCannotBeSavedException  
		- TaskCannotBeRemovedException  
	- Query
	    - > getTaskById
		- > getAllRemainingTasks
		- > getAllCompletedTasks
	- Command
		- > addNewTask
		- > completeTask
		- > redoTask
		- > editTask
		- > removeTask
		- > cleanAllCompletedTasks

# Infrastructure
- Persistence
	- DoctrineORM
		- Repository  
			- TaskRepository 
				- > findAll
	 			- > find
	 			- > findAllByStatus
				- > save
				- > remove

	- Eloquent
		- Repository
			- TaskRepository
				- > findAll
	 			- > find
	 			- > findAllByStatus
				- > save
				- > remove
