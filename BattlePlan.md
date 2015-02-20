// easy instantiation

//api wrapper with base classes - use settings to override

//php config - PHP array


core adapters
   DB
   Email
   Session - use PHP session by default



Basic shit to get it working. Then abstract



Command
Repository
Entities


Entities talk to commands
Commands talk repositories

Entities have business logic

Top level wrapper to wrap entities - will later become adapters for diff frameworks
