import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter/rendering.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:zero_stress_app/helpers/custom_job_card.dart';
import 'package:zero_stress_app/screens/provider_screens/provider_add_service_screen.dart';
import 'package:zero_stress_app/screens/provider_screens/provider_job_detail_screen.dart';
import 'package:zero_stress_app/services/reservation_services.dart';

import '../../helpers/custom_home_header.dart';
import '../../helpers/slide_route.dart';
import '../../models/connected_user.dart';
import '../../models/reservation.dart';
import '../../services/user_services.dart';
import '../enterprise_screens/add_offre_emploi_screen.dart';

class ProviderHomeScreen extends ConsumerStatefulWidget {
  const ProviderHomeScreen({super.key});

  @override
  ConsumerState<ProviderHomeScreen> createState() => _ProviderHomeScreenState();
}

class _ProviderHomeScreenState extends ConsumerState<ProviderHomeScreen> {
  final TextEditingController _searchController = TextEditingController();
  final ScrollController _scrollController = ScrollController();
  final ValueNotifier<bool> _showFabText = ValueNotifier(true);
  DateTime? lastPressed;
  String _firstname = "";

  @override
  void initState() {
    super.initState();
    _searchController.addListener(_onSearchChanged);
    _scrollController.addListener(_scrollListener);
    WidgetsBinding.instance.addPostFrameCallback((_) {
      _loadFirstName();
    });
  }

  @override
  void dispose() {
    _searchController.removeListener(_onSearchChanged);
    _searchController.dispose();
    _scrollController.removeListener(_scrollListener);
    _scrollController.dispose();
    _showFabText.dispose();
    super.dispose();
  }

  Future<void>  _loadFirstName() async {
    final SharedPreferences prefs = await SharedPreferences.getInstance();
    String? token = prefs.getString('token');
    try{
      ConnectedUser connectedUser = await ref.read(userServiceProvider).fetchAndStoreUserData(token!);

      if(mounted){
        setState(() {
          _firstname = connectedUser.firstname;
        });
      }
    } catch(e) {
      if(mounted){
        throw Exception(e.toString());
      }
    }
  }

  _onSearchChanged() {
    if (kDebugMode) {
      print(_searchController.text);
    }
  }

  void _scrollListener() {
    if (_scrollController.position.userScrollDirection == ScrollDirection.reverse) {
      _showFabText.value = false;
    } else if (_scrollController.position.atEdge && _scrollController.position.pixels == 0) {
      _showFabText.value = true;
    }
  }

  Future<void> _refreshData() async {
    setState(() {

    });
  }

  @override
  Widget build(BuildContext context) {
    final reservationService = ref.read(reservationServiceProvider);
    return Scaffold(
      appBar: AppBar(
        toolbarHeight: 0,
        backgroundColor: const Color(0xFFE9EDF2),
      ),
      body: Column(
        children: [
          Stack(
            clipBehavior: Clip.none,
            children: [
              CustomHomeHeader(
                username: _firstname,
                description: 'Trouvez le job qui vous convient.',
              ),
              Positioned(
                  top: 95,
                  left: 0,
                  right: 0,
                  child: Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 25.0),
                    child: searchBar(context: context, controller: _searchController),
                  )
              ),
            ],
          ),
          const SizedBox(height: 40,),
          Expanded(
            child: RefreshIndicator(
              onRefresh: _refreshData,
              child: ListView(
                controller: _scrollController,
                children: [
                  Padding(
                    padding: const EdgeInsets.only(left: 25.0),
                    child: Align(
                      alignment: Alignment.topLeft,
                      child: Text(
                        "Récemment postés",
                        style: GoogleFonts.dmSans(fontSize: 18, fontWeight: FontWeight.w500),
                      ),
                    ),
                  ),
                  FutureBuilder<List<Reservation>>(
                    future: reservationService.getReservations(),
                    builder: (context, snapshot) {
                      if (snapshot.connectionState == ConnectionState.waiting) {
                        return const Center(child: CircularProgressIndicator());
                      }
                      if (snapshot.hasError) {
                        return const Padding(
                          padding: EdgeInsets.only(left: 25.0),
                          child: Text("Quelque chose se passe mal..."),
                        );
                      }
                      if (snapshot.hasData && snapshot.data!.isNotEmpty) {
                        var reservationsToShow = snapshot.data!.take(2).toList();
                        return ListView.builder(
                          shrinkWrap: true,
                          physics: const NeverScrollableScrollPhysics(),
                          itemCount: reservationsToShow.length,
                          itemBuilder: (context, index) {
                            var reservation = reservationsToShow[index];
                            return Padding(
                              padding: const EdgeInsets.symmetric(horizontal: 25.0),
                              child: Column(
                                children: [
                                  CustomJobCard(
                                    jobId: reservation.id!,
                                    initials: 'AB',
                                    userId: reservation.accountId,
                                    jobTitle: reservation.name,
                                    location: reservation.account!["user"]["adress"] ?? "A définir par le client",
                                    price: "${reservation.totalAmount!} FCFA",
                                    description: reservation.description,
                                    onCardClick: () {
                                      Navigator.of(context).push(
                                          SlideRoute(page: ProviderJobDetailScreen(jobId: reservation.id!))
                                      );
                                    },
                                  ),
                                ],
                              ),
                            );
                          },
                        );
                      } else {
                        return const Padding(
                          padding: EdgeInsets.only(left: 25.0),
                          child: Text('Aucune réservation trouvée'),
                        );
                      }
                    },
                  ),
                  const SizedBox(height: 20),
                  Padding(
                    padding: const EdgeInsets.only(left: 25.0),
                    child: Align(
                      alignment: Alignment.topLeft,
                      child: Text(
                        "Tous les jobs",
                        style: GoogleFonts.dmSans(fontSize: 18, fontWeight: FontWeight.w500),
                      ),
                    ),
                  ),
                  FutureBuilder<List<Reservation>>(
                    future: reservationService.getReservations(),
                    builder: (context, snapshot) {
                      if (snapshot.connectionState == ConnectionState.waiting) {
                        return const Center(child: CircularProgressIndicator());
                      }
                      if (snapshot.hasError) {
                        return const Padding(
                          padding: EdgeInsets.only(left: 25.0),
                          child: Text("Quelque chose se passe mal..."),
                        );
                      }
                      if (snapshot.hasData && snapshot.data!.isNotEmpty) {
                        return Column(
                          children: snapshot.data!.map((reservation) {
                            return Padding(
                              padding: const EdgeInsets.symmetric(horizontal: 25.0),
                              child: Column(
                                children: [
                                  CustomJobCard(
                                    jobId: reservation.id!,
                                    initials: 'AB',
                                    userId: reservation.accountId,
                                    jobTitle: reservation.name,
                                    location: reservation.account!["user"]["adress"] ?? "A définir par le client",
                                    price: "${reservation.totalAmount!} FCFA",
                                    description: reservation.description,
                                    onCardClick: () {
                                      Navigator.of(context).push(
                                          SlideRoute(page: ProviderJobDetailScreen(jobId: reservation.id!))
                                      );
                                    },
                                  ),
                                ],
                              ),
                            );
                          }).toList(),
                        );
                      } else {
                        return const Padding(
                          padding: EdgeInsets.only(left: 25.0),
                          child: Text('Aucun réservation trouvée'),
                        );
                      }
                    },
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
      floatingActionButton: ValueListenableBuilder<bool>(
        valueListenable: _showFabText,
        builder: (context, showText, child) {
          return AnimatedSwitcher(
            duration: const Duration(milliseconds: 300),
            child: showText ? FloatingActionButton.extended(
              key: UniqueKey(),
              onPressed: () {
                Navigator.of(context).push(
                  SlideRoute(page: const ProviderAddServiceScreen()),
                );
              },
              label: Text(
                'Nouveau service',
                style: GoogleFonts.dmSans(
                  color: Colors.white,
                ),
              ),
              icon: const Icon(
                Icons.add,
                color: Colors.white,
              ),
              backgroundColor: Theme.of(context).colorScheme.primary,
            ) : FloatingActionButton(
              key: UniqueKey(),
              onPressed: () {
                Navigator.of(context).push(
                  SlideRoute(page: const AddOffreEmploiScreen()),
                );
              },
              backgroundColor: Theme.of(context).colorScheme.primary,
              child: const Icon(
                Icons.add,
                color: Colors.white,
              ),
            ),
          );
        },
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.endFloat,
    );
  }

  Widget searchBar({required BuildContext context, required TextEditingController controller}) {
    return SizedBox(
      height: 45,
      child: TextField(
        controller: controller,
        decoration: InputDecoration(
          hintText: 'Rechercher',
          hintStyle: GoogleFonts.dmSans(
              color: const Color(0xFFC5C5C5),
              fontSize: 14,
              fontWeight: FontWeight.normal
          ),
          prefixIcon: const Icon(
            Icons.search,
            color: Color(0xFFD8D8D8),
            size: 24,
          ),
          fillColor: Colors.white,
          filled: true,
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(5.0),
            borderSide: const BorderSide(
              width: 1,
              color: Color(0xFFDCDCDC),
            ),
          ),
          enabledBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(5.0),
            borderSide: const BorderSide(
              width: 1,
              color: Color(0xFFDCDCDC),
            ),
          ),
          focusedBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(5.0),
            borderSide: const BorderSide(
              width: 1,
              color: Color(0xFFDCDCDC),
            ),
          ),
        ),
      ),
    );
  }
}
